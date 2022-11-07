import { Node } from '@tiptap/core';
import { mergeAttributes } from "@tiptap/vue-3";

export default Node.create({
    name: 'nodeAddressField',

    group: 'block',

    inline: false,

    content: 'text*',

    addAttributes() {
        return {
            name: {
                parseHTML: element => element.getAttribute('name'),
            },
            left: {
                parseHTML: element => element.getAttribute('left'),
            },
            width: {
                parseHTML: element => element.getAttribute('width'),
            },
            height: {
                parseHTML: element => element.getAttribute('height'),
            }
        }
    },

    parseHTML() {
        return [
            {
                tag: 'address-field',
            },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        return ['address-field', mergeAttributes(HTMLAttributes)]
    },

    addNodeView() {
        return ({ editor, node, getPos, HTMLAttributes, decorations, extension }) => {
            const dom = document.createElement('div');
            dom.classList.add('address__field');
            dom.id = HTMLAttributes.name;
            dom.contentEditable = false;

            const container = document.createElement('div');
            container.classList.add('address__container');
            container.contentEditable = false;
            container.style.left = HTMLAttributes.left + '%';
            container.style.width = HTMLAttributes.width + '%';
            container.style.paddingTop = HTMLAttributes.height + '%';

            const group = document.createElement('div');
            group.classList.add('address__group');
            group.contentEditable = false;
            group.style.left = HTMLAttributes.left + '%';
            group.style.width = HTMLAttributes.width + '%';

            for(let i = 1; i <= 3; i++) {
                const line_address = document.createElement('div');

                line_address.contentEditable = true;
                line_address.setAttribute('aria-placeholder', 'line_address_' + i);

                group.appendChild(line_address);
            }

            dom.appendChild(container);
            dom.appendChild(group);

            return {
                dom,
            }
        }
    },
});
