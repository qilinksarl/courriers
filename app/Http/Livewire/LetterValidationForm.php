<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\OptionData;
use App\Enums\PostageType;
use App\Settings\AccountingSettings;
use App\Settings\PricingSettings;
use App\Traits\Subscriptionable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;

class LetterValidationForm extends Component
{
    use Subscriptionable;

    /**
     * @var bool
     */
    public bool $showPreview = false;

    /**
     * @var string|null
     */
    public ?string $previewUrl = null;

    /**
     * @var float
     */
    public float $amount = 0.0;

    /**
     * @var array
     */
    public array $options = [];

    /**
     * @var array
     */
    public array $pricing = [];

    /**
     * @var string|null
     */
    public ?string $phone = null;

    /**
     * @var bool
     */
    public bool $customerCertifiesDocumentsAreCompliant = false;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'phone' => [
                Rule::requiredIf(fn () => in_array('sms_notification', $this->options, true)),
                'regex:/^0[6-7]\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]/i'
            ],
            'customerCertifiesDocumentsAreCompliant' => 'accepted'
        ];
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $cart = App::make(Cart::class);

        $order = $cart->getOrder();

        $this->pricing = App::make(PricingSettings::class)->toArray();

        if($order->amount) {
            $this->amount = $order->amount;
        } else {
            $this->amount = $cart->getPostageType()->price() * $cart->getRecipients()->count();
            $this->amount += $this->pricing['black_print'] * collect($cart->getDocuments())->sum('number_of_pages');

            if($cart->getPostageType() === PostageType::REGISTERED_LETTER) {
                $this->options[] = 'receipt';
                $this->amount += $this->pricing['receipt'] * $cart->getRecipients()->count();
            }
        }

        if($order->options) {
            $this->options = Arr::pluck($order->toArray()['options'], 'name');

            if(in_array('sms_notification', $this->options, true)) {
                $customer = $cart->getCustomer();
                $this->phone = '0' . substr($customer->phone, 3);
            }
        }

        $this->customerCertifiesDocumentsAreCompliant = $order->customer_certifies_documents_are_compliant;
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id): void
    {
        $this->previewUrl = route('frontend.letter.preview', ['id' => $id]);
        $this->showPreview = true;
    }

    /**
     * @return void
     */
    public function hidden(): void
    {
        $this->previewUrl = null;
        $this->showPreview = false;
    }

    /**
     * @param array $value
     * @return void
     */
    public function updatedOptions(array $value): void
    {
        $cart = App::make(Cart::class);

        if(! empty($value)) {
            $quantity = ($value[0] === 'color_print') ? collect($cart->getDocuments())->sum('number_of_pages') : $cart->getRecipients()->count();

            if(in_array($value[0], $this->options, true)) {
                $this->amount += $this->pricing[$value[0]] * $quantity;

                if($value[0] === 'color_print') {
                    $this->amount -= $this->pricing['black_print'] * $quantity;
                }
            } else {
                $this->amount -= $this->pricing[$value[0]] * $quantity;

                if($value[0] === 'color_print') {
                    $this->amount += $this->pricing['black_print'] * $quantity;
                }
            }
        } else {
            $this->amount = $cart->getPostageType()->price() * $cart->getRecipients()->count();
            $this->amount += $this->pricing['black_print'] * collect($cart->getDocuments())->sum('number_of_pages');
        }
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $cart = App::make(Cart::class);

        $options = [];

        foreach ($this->options as $option) {
            $options[] = new OptionData(
                name: $option,
                price: $this->pricing[$option],
            );
        }

        $order = $cart->getOrder();
        $order->options = OptionData::collection($options);
        $order->amount = $this->amount;
        $order->customer_certifies_documents_are_compliant = $this->customerCertifiesDocumentsAreCompliant;
        $cart->addOrder($order);

        if($this->phone && in_array('sms_notification', $this->options, true)) {
            $customer = $cart->getCustomer();
            $customer->phone = '+33' . substr(str_replace(' ', '', $this->phone), 1);
            $cart->addCustomer($customer);
        }

        return redirect()->route('frontend.letter.payment');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $cart = App::make(Cart::class);
        $accountingSettings = App::make(AccountingSettings::class);

        return view('livewire.letter-validation-form', [
            'cart' => $cart,
            'rat_vat' => $accountingSettings->vat_rate,
        ]);
    }
}
