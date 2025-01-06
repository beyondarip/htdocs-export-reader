<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claude Chat Interface</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/9.1.6/marked.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="./assets/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/inter/3.19.3/inter.css" rel="stylesheet">


    <!-- Local CSS -->

    <link href="assets/tailwind.min.css" rel="stylesheet">
    <link href="assets/highlight.min.css" rel="stylesheet">
    <link href="assets/plus-jakarta-sans.css" rel="stylesheet">

    <!-- Local JavaScript -->
    <script src="assets/markdown-it.min.js"></script>
    <script src="assets/highlight.min.js"></script>
    <script src="assets/python.min.js"></script>
    <script src="assets/javascript.min.js"></script>
    <script src="assets/bash.min.js"></script>
    <script src="assets/php.min.js"></script>


    <style>
        .prose {
            color: #E5E7EB;
            max-width: none;
        }

        .prose ul {
            list-style-type: disc;
            margin-left: 1.5em;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .prose ol {
            list-style-type: decimal;
            margin-left: 1.5em;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .prose li {
            margin: 0.5em 0;
            padding-left: 0.5em;
        }

        .prose h1 {
            font-size: 1.8em;
            font-weight: 600;
            margin: 1em 0;
        }

        .prose h2 {
            font-size: 1.5em;
            font-weight: 600;
            margin: 1em 0;
        }

        .prose h3 {
            font-size: 1.3em;
            font-weight: 600;
            margin: 1em 0;
        }

        .prose p {
            margin: 1em 0;
            line-height: 1.6;
        }

        .prose blockquote {
            border-left: 3px solid #4B5563;
            padding-left: 1em;
            margin: 1em 0;
            color: #9CA3AF;
        }

        .prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 1em 0;
        }

        .prose th,
        .prose td {
            padding: 0.5em;
            border: 1px solid #4B5563;
        }

        .prose pre {
            margin: 1em 0;
            background: #2E3440;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .prose code {
            font-family: Menlo, Monaco, Consolas, 'Liberation Mono', monospace;
            font-size: 0.9em !important;
        }

        .prose :not(pre)>code {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.2em 0.4em;
            border-radius: 0.3em;
            color: #E5E7EB;
        }

        .prose pre code {
            padding: 0;
            background: transparent;
            border: none;
            line-height: 1.5;
            color: inherit;
            font-size: 0.9em !important;
        }

        .prose p {
            margin: 1em 0;
            line-height: 1.6;
        }

        .prose ul,
        .prose ol {
            margin: 1em 0;
            padding-left: 1.5em;
        }

        .prose li {
            margin: 0.5em 0;
        }

        .prose blockquote {
            margin: 1em 0;
            padding-left: 1em;
            border-left: 4px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
        }


        /* Background */
        .animated-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(circle at 10% 10%, rgba(124, 58, 237, 0.15), transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(124, 58, 237, 0.15), transparent 40%);
            opacity: 0.5;
        }

        /* Message Styling */
        .prose pre {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(124, 58, 237, 0.2);
            border-radius: 8px;
            margin: 1rem 0;
        }

        .prose code {
            color: #A5B4FC;
            background: rgba(124, 58, 237, 0.1);
            padding: 0.2em 0.4em;
            border-radius: 4px;
            font-size: 0.9em;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .chat-message {
            animation: fadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .prose pre {
            background: #1a1a1a;
            padding: 1.25rem;
            border-radius: 0.75rem;
            margin: 1.25rem 0;
            border: 1px solid #2d2d2d;
        }

        .prose code {
            color: #e0e0e0;
            background: #1a1a1a;
            padding: 0.2rem 0.4rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .chat-item:hover .chat-item-icons {
            opacity: 1;
        }

        .scrollbar-custom::-webkit-scrollbar {
            width: 10px;
        }

        .scrollbar-custom::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-custom::-webkit-scrollbar-thumb {
            background: #4b4b4b;
            border-radius: 20px;
        }

        #loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            z-index: 1000;
        }
    </style>
</head>

<body class="bg-[#0C0C0D] text-white min-h-screen">

    <div id="loading">Loading...</div>
    <div class="flex h-screen">
        <div class="absolute z-2 top-0 inset-x-0 flex justify-center overflow-hidden pointer-events-none">
            <div class="w-full h-full flex-none flex justify-end">
                <img src="./dark.png" alt="" srcset="">
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-[320px] border-r border-zinc-800/80 flex flex-col bg-[#0C0C0D]">
            <!-- Top Section -->
            <div class="p-4 border-b border-zinc-800/80">
                <button class="w-full bg-zinc-800 hover:bg-zinc-700 text-white rounded-lg py-3 px-4 font-medium transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Chat
                </button>
            </div>

            <!-- Chat List -->
            <div id="chatList" class="flex-1 overflow-y-auto scrollbar-custom p-2 space-y-1">
                <!-- Chat items will be inserted here -->
            </div>

            <!-- Bottom Section -->
            <div class="p-4 border-t border-zinc-800/80">
                <div class="flex items-center gap-3 p-3 hover:bg-zinc-800/60 rounded-lg cursor-pointer transition-all">
                    <div class="w-8 h-8 rounded-full bg-gray-500 flex items-center justify-center">
                        <span class="text-sm font-medium">U</span>
                    </div>
                    <span class="text-sm font-medium">User</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-[#0C0C0D]">
            <!-- Chat Header -->
            <div class="h-16 border-b border-zinc-800/80 flex items-center px-6">
                <h1 id="chatTitle" class="text-lg font-semibold text-zinc-100">Select a chat</h1>
            </div>

            <!-- Chat Container -->
            <div id="chatContainer" class="flex-1 overflow-y-auto scrollbar-custom">
                <div class="max-w-4xl mx-auto py-8 px-6 space-y-8">
                    <!-- Messages will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <script>
     class ChatUI {
    constructor() {
        this.chatList = document.getElementById('chatList');
        this.chatContainer = document.getElementById('chatContainer').querySelector('div');
        this.chatTitle = document.getElementById('chatTitle');
        this.loading = document.getElementById('loading');
        this.initMarkdown();
        this.loadChats();
        this.addScrollButton();
    }

    initMarkdown() {
        this.md = window.markdownit({
            html: true,
            breaks: true,
            linkify: true,
            typographer: true,
            highlight: (str, lang) => {
                if (lang && hljs.getLanguage(lang)) {
                    try {
                        return hljs.highlight(str, {
                            language: lang
                        }).value;
                    } catch (__) {}
                }
                return '';
            }
        });
    }

    showLoading() {
        this.loading.style.display = 'block';
    }

    hideLoading() {
        this.loading.style.display = 'none';
    }

    async loadChats() {
        try {
            this.showLoading();
            const response = await fetch('api.php?action=list');
            const items = await response.json();

            this.chatList.innerHTML = '';
            items.forEach(item => this.addChatToList(item));
        } catch (error) {
            console.error('Failed to load chats:', error);
        } finally {
            this.hideLoading();
        }
    }

    addChatToList(item, level = 0) {
        if (item.type === 'folder') {
            const folderDiv = document.createElement('div');
            folderDiv.className = 'ml-' + (level * 4);
            folderDiv.innerHTML = `
                <div class="flex items-center p-2 text-zinc-400 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    ${item.title}
                </div>
            `;
            this.chatList.appendChild(folderDiv);
            
            item.items.forEach(subItem => this.addChatToList(subItem, level + 1));
        } else {
            const chatDiv = document.createElement('div');
            chatDiv.className = `chat-item group p-3 hover:bg-zinc-800/60 rounded-lg cursor-pointer transition-all ml-${level * 4}`;
            chatDiv.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-zinc-100 text-sm">${item.title}</h3>
                        <p class="text-xs text-zinc-400 mt-1">${item.date}</p>
                    </div>
                    <div class="chat-item-icons opacity-0 transition-opacity flex gap-2">
                        <button class="p-1 hover:bg-zinc-700 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            chatDiv.addEventListener('click', () => this.loadChat(item.id, item.title));
            this.chatList.appendChild(chatDiv);
        }
    }

    
    addScrollButton() {
        const button = document.createElement('button');
        button.className = 'fixed bottom-4 right-4 bg-zinc-800 hover:bg-zinc-700 text-white rounded-lg p-3 shadow-lg transition-colors z-50';
        button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7"/>
            </svg>
        `;
        button.onclick = () => this.scrollToBottom();
        document.body.appendChild(button);
    }

    scrollToBottom() {
        this.chatContainer.parentElement.scrollTo({
            top: this.chatContainer.parentElement.scrollHeight,
            behavior: 'smooth'
        });
    }

    async loadChat(chatId, title) {
        try {
            this.showLoading();
            const response = await fetch(`api.php?action=chat&id=${chatId}`);
            const data = await response.json();

            if (data.success) {
                this.chatContainer.innerHTML = '';
                this.chatTitle.textContent = title;
                data.messages.forEach(msg => this.renderMessage(msg.content, msg.isUser));
                this.chatContainer.parentElement.scrollTop = 0;
                // this.scrollToBottom();
            }
        } catch (error) {
            console.error('Failed to load chat:', error);
            alert('Error loading chat. Please check console.');
        } finally {
            this.hideLoading();
        }
    }

    renderMessage(content, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message flex ${isUser ? 'justify-end' : 'justify-start'}`;

        const wrapperDiv = document.createElement('div');
        wrapperDiv.className = 'message-wrapper relative';

        const innerDiv = document.createElement('div');
        innerDiv.className = `max-w-3xl z-20 ${isUser ? 'bg-gray-500/10 border border-gray-500/20' : 'bg-zinc-800/60'} rounded-2xl p-6 prose prose-invert prose-p:leading-relaxed prose-pre:my-4`;

        const copyButton = document.createElement('button');
        copyButton.className = 'copy-button absolute top-4 right-4 flex items-center gap-2 px-2 py-1 text-xs text-zinc-400 hover:bg-zinc-700/50 rounded transition-colors';
        copyButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            <span>Copy</span>
        `;

        copyButton.addEventListener('click', () => this.copyToClipboard(content, copyButton));

        const htmlContent = this.md.render(content);
        innerDiv.innerHTML = htmlContent;

        innerDiv.querySelectorAll('pre code').forEach(block => {
            hljs.highlightElement(block);
        });

        wrapperDiv.appendChild(innerDiv);
        wrapperDiv.appendChild(copyButton);
        messageDiv.appendChild(wrapperDiv);
        this.chatContainer.appendChild(messageDiv);
    }

    async copyToClipboard(text, button) {
        try {
            await navigator.clipboard.writeText(text);
            button.innerHTML = `<span>Copied!</span>`;
            setTimeout(() => {
                button.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <span>Copy</span>
                `;
            }, 2000);
        } catch (err) {
            console.error('Failed to copy:', err);
        }
    }
}

// Initialize UI
document.addEventListener('DOMContentLoaded', () => {
    window.chatUI = new ChatUI();
});
    </script>
</body>

</html>