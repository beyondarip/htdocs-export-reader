<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimized Chat Interface</title>
   


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
    
    <!-- Tailwind masih menggunakan CDN karena ukurannya besar -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #7C3AED;
            --surface: #1A1A2E;
            --surface-dark: #15152A;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface-dark);
            color: #E2E8F0;
        }

        /* Optimized Scrollbar */
        ::-webkit-scrollbar {
            width: 15px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }

        /* Simple Animations */
        .chat-message {
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Optimized Card Style */
        .card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
        }

        /* Copy Button */
        .copy-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(124, 58, 237, 0.1);
            border: 1px solid rgba(124, 58, 237, 0.2);
            border-radius: 8px;
            color: #E2E8F0;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .message-wrapper:hover .copy-button {
            opacity: 1;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 1.5rem;
            background: var(--primary);
            border-radius: 8px;
            color: white;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.2s ease;
            z-index: 1000;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Button Style */
        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Chat Item */
        .chat-item {
            transition: background-color 0.2s;
            border: 1px solid transparent;
        }

        .chat-item:hover {
            background: rgba(124, 58, 237, 0.1);
        }


        

        .chat-message { animation: fadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
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

.prose th, .prose td {
    padding: 0.5em;
    border: 1px solid #4B5563;
}
        .prose pre {
            margin: 1em 0;
            background: #2E3440;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .prose code {
            font-family: Menlo, Monaco, Consolas, 'Liberation Mono', monospace;
            font-size: 0.9em !important;
        }
        
        .prose :not(pre) > code {
            background: rgba(255,255,255,0.1);
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
        
        .prose p { margin: 1em 0; line-height: 1.6; }
        .prose ul, .prose ol { margin: 1em 0; padding-left: 1.5em; }
        .prose li { margin: 0.5em 0; }
        .prose blockquote {
            margin: 1em 0;
            padding-left: 1em;
            border-left: 4px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.8);
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
    </style>
</head>
<body class="min-h-screen">
    <div class="animated-bg"></div>

    <div class="container mx-auto p-6 h-screen flex gap-6">
        <!-- Sidebar -->
        <div class="w-[400px] card flex flex-col overflow-hidden">
            <!-- New Chat Button -->
            <div class="p-5 border-b border-white/10">
                <button class="btn-primary w-full flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Chat
                </button>
            </div>

            <!-- Chat List -->
            <div id="chatList" class="flex-1 overflow-y-auto p-4 space-y-3">
                <!-- Chat items will be inserted here -->
            </div>

            <!-- User Profile -->
            <div class="p-5 border-t border-white/10">
                <div class="rounded-xl p-4 flex items-center gap-4 bg-white/5">
                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center font-semibold text-lg">
                        U
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-lg">User Name</div>
                        <div class="text-sm text-violet-300">Premium Account</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 card flex flex-col overflow-hidden">
            <!-- Chat Header -->
            <div class="h-20 border-b border-white/10 flex items-center justify-between px-8">
                <h1 id="chatTitle" class="text-2xl font-semibold">Welcome to Chat</h1>
            </div>

            <!-- Messages Container -->
            <div id="chatContainer" class="flex-1 overflow-y-auto">
                <div class="max-w-4xl mx-auto py-8 px-6 space-y-6">
                    <!-- Messages will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loading" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
        <div class="p-6 rounded-2xl bg-surface">
            <div class="w-12 h-12 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="toast">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span>Copied to clipboard!</span>
    </div>

    <script>
        class ChatUI {
            constructor() {
                this.initComponents();
                this.initMarkdownParser();
                this.loadChats().catch(err => this.showError(err.message));
            }

            initComponents() {
                this.chatList = document.getElementById('chatList');
                this.chatContainer = document.getElementById('chatContainer').querySelector('div');
                this.chatTitle = document.getElementById('chatTitle');
                this.loading = document.getElementById('loading');
                this.error = document.getElementById('error');
                this.toast = document.getElementById('toast');
            }

            initMarkdownParser() {
                this.md = window.markdownit({
                    html: true,
                    breaks: true,
                    linkify: true,
                    typographer: true,
                    highlight: (str, lang) => {
                        if (lang && hljs.getLanguage(lang)) {
                            try {
                                return hljs.highlight(str, { language: lang }).value;
                            } catch (__) {}
                        }
                        return '';
                    }
                });
            }

            showToast(message = 'Copied to clipboard!') {
                this.toast.querySelector('span').textContent = message;
                this.toast.classList.add('show');
                setTimeout(() => this.toast.classList.remove('show'), 2000);
            }

            async copyToClipboard(text, button) {
                try {
                    await navigator.clipboard.writeText(text);
                    button.textContent = 'Copied!';
                    this.showToast();
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

            showLoading() { this.loading.classList.remove('hidden'); }
            hideLoading() { this.loading.classList.add('hidden'); }

            renderMessage(content, isUser) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `chat-message flex ${isUser ? 'justify-end' : 'justify-start'}`;
                
                const wrapperDiv = document.createElement('div');
                wrapperDiv.className = 'message-wrapper relative';
                
                const innerDiv = document.createElement('div');
                innerDiv.className = `max-w-3xl ${isUser ? 'bg-primary/10 border border-primary/20' : 'bg-white/5'} rounded-2xl p-6 prose prose-invert`;
                
                const copyButton = document.createElement('button');
                copyButton.className = 'copy-button';
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

            addChatToList(chat) {
                const chatItem = document.createElement('div');
                chatItem.className = 'chat-item p-3 rounded-lg cursor-pointer';
                chatItem.innerHTML = `
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-white/90 text-sm">${chat.title}</h3>
                            <p class="text-xs text-white/60 mt-1">${chat.date}</p>
                        </div>
                    </div>
                `;
                
                chatItem.addEventListener('click', () => {
                    this.loadChat(chat.id, chat.title).catch(err => this.showError(err.message));
                });
                
                this.chatList.appendChild(chatItem);
            }

            // Rest of the original methods remain the same
            async loadChats() {
                /* Original loadChats implementation */
            }
            async loadChat(chatId, title) {
                try {
                    this.showLoading();
                    const response = await fetch(`api.php?action=chat&id=${chatId}`);
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    const data = await response.json();
                    
                    if (!data.success) throw new Error(data.error || 'Failed to load chat');
                    
                    this.chatContainer.innerHTML = '';
                    this.chatTitle.textContent = title;
                    
                    if (data.messages) {
                        data.messages.forEach(msg => this.renderMessage(msg.content, msg.isUser));
                    }
                    
                    this.chatContainer.parentElement.scrollTop = 0;
                } catch (err) {
                    this.showError(err.message);
                } finally {
                    this.hideLoading();
                }
            }

            async loadChats() {
                try {
                    this.showLoading();
                    const response = await fetch('api.php?action=list');
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    const data = await response.json();
                    
                    if (!data.success) throw new Error(data.error || 'Failed to load chats');
                    
                    this.chatList.innerHTML = '';
                    if (data.chats) {
                        data.chats.forEach(chat => this.addChatToList(chat));
                    }
                } catch (err) {
                    this.showError(err.message);
                } finally {
                    this.hideLoading();
                }
            }

            showError(message) {
                console.error(message);
                this.showToast(message, true);
                setTimeout(() => {
                    const toast = this.toast;
                    toast.classList.remove('show');
                }, 3000);
            }
        }

        // Initialize the Chat UI when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.chatUI = new ChatUI();
        });
    </script>
</body>
</html>