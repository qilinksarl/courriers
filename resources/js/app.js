import './bootstrap';
import Alpine from 'alpinejs';
import { Editor, Node } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Underline from '@tiptap/extension-underline';
import * as FilePond from 'filepond';

window.FilePond = FilePond;

window.setupEditor = function (content) {
    return {
        editor: null,
        content: content,
        init(element) {
            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit.configure({
                        heading: {
                            levels: [1, 2, 3],
                        },
                    }),
                    Underline,
                ],
                content: this.content,
                onUpdate: ({editor}) => {
                    this.content = editor.getHTML();
                }
            });
            this.$watch('content', (content) => {
                if (content === this.editor.getHTML()) return;
                this.editor.commands.setContent(content, false);
            });
        }
    }
}

window.Alpine = Alpine;

Alpine.start();
