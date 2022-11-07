<section class="grid grid-cols-1 md:grid-cols-[1fr,33%] gap-4 md:gap-12">
    <div class="bg-white p-6 shadow-lg shadow-gray-300/40 rounded-md">
        <form id="hipay-form">
            <div id="hipay-hostedfields-form"></div>
            <div class="multiuse-container">
                <input type="checkbox" id="save-card" name="save-card">
                <label for="save-card">Save card</label>
            </div>
            <button type="submit" id="hipay-submit-button" disabled="true">
                PAY
            </button>
            <div id="hipay-error-message"></div>
        </form>
    </div>
    <div class="bg-amber-50 p-6 rounded-sm">
        1
    </div>
</section>
