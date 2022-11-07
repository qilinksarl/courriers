import './bootstrap';
import Alpine from 'alpinejs';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Underline from '@tiptap/extension-underline';
import * as FilePond from 'filepond';
import NodeTextField from "./Tiptap/NodeTextField";
import NodeAddressField from "./Tiptap/NodeAddressField";

window.FilePond = FilePond;

window.setupEditor = function (model) {
    return {
        editor: null,
        content: model,
        init(element, isEditable) {
            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit.configure({
                        heading: {
                            levels: [1, 2, 3],
                        },
                    }),
                    Underline,
                    NodeTextField,
                ],
                editable: isEditable,
                content: `
                    ${this.content.text}
                `,
                onUpdate: ({editor}) => {
                    this.content.text = editor.getHTML();
                    this.content.json = editor.getJSON();
                },
                onSelectionUpdate: ({ editor }) => {
                    console.log('s', editor);
                },
                onTransaction: ({ editor, transaction }) => {
                    console.log('t', transaction);
                },
                onFocus: ({ editor, event }) => {
                    console.log('e', event);
                }
            });

            this.$watch('content', (content) => {
                if (content.text === this.editor.getHTML()) return;
                this.editor.commands.setContent(content.text, false);
            });
        }
    }
}

window.Alpine = Alpine;

Alpine.start();
