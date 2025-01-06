

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>

     
    <script src="https://cdn.jsdelivr.net/npm/markdown-it@13.0.2/dist/markdown-it.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <!-- Languages you need -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/nord.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">


      <!-- Libraries -->
      <script src="https://cdn.jsdelivr.net/npm/markdown-it@13.0.2/dist/markdown-it.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    
    <!-- Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/markdown-it@13.0.2/dist/markdown-it.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0A0A0F;
            --accent: #6366F1;
            --accent-dark: #4F46E5;
            --text: #E2E8F0;
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
        
        .scrollbar-custom::-webkit-scrollbar { width: 5px; }
        .scrollbar-custom::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-custom::-webkit-scrollbar-thumb { background: #4b4b4b; border-radius: 20px; }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
        }

        .neo-brutalism {
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 4px 4px 0 rgba(99,102,241,0.2);
        }

        .glass {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.05);
        }

        .floating-gradient {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: -1;
            opacity: 0.15;
            background: 
                radial-gradient(circle at 0% 0%, #4F46E5 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, #6366F1 0%, transparent 50%);
            filter: blur(80px);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-10px) scale(1.02); }
        }

        @keyframes glow {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.6; }
        }

        .animate-float {
            animation: float 6s infinite ease-in-out;
        }

        .animate-glow {
            animation: glow 4s infinite ease-in-out;
        }

        .chat-container::-webkit-scrollbar {
            width: 6px;
        }

        .chat-container::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.02);
            border-radius: 3px;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background: rgba(99,102,241,0.3);
            border-radius: 3px;
        }

        .prose pre {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(99,102,241,0.2);
        }

        .prose code {
            color: #A5B4FC;
            background: rgba(99,102,241,0.1);
        }

        .message-bubble {
            position: relative;
            overflow: hidden;
        }

        .message-bubble::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.2), transparent);
        }

        .sidebar-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-item:hover {
            transform: translateX(4px);
            background: rgba(99,102,241,0.1);
        }

        .gradient-border {
            position: relative;
            background: var(--bg-dark);
            z-index: 1;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: linear-gradient(45deg, var(--accent), var(--accent-dark));
            z-index: -1;
            border-radius: inherit;
            opacity: 0.3;
        }
    </style>
</head>
<body class="min-h-screen text-gray-100">
    <!-- Gradient Background -->
    <div class="floating-gradient"></div>

    <div class="container mx-auto p-4 h-screen flex gap-4">
        <!-- Sidebar -->
        <div class="w-[380px] glass rounded-2xl flex flex-col overflow-hidden neo-brutalism">
            <!-- New Chat Button -->
            <div class="p-4 border-b border-white/5">
                <button class="w-full py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition-all flex items-center justify-center gap-2 neo-brutalism">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Chat
                </button>
            </div>

            <!-- Chat List -->
            <div id="chatList" class="flex-1 overflow-y-auto chat-container p-3 space-y-2">
                <!-- Chat items will be inserted here -->
            </div>

            <!-- User Profile -->
            <div class="p-4 border-t border-white/5">
                <div class="glass rounded-xl p-3 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-600 to-indigo-800 flex items-center justify-center font-medium">
                        U
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">User</div>
                        <div class="text-xs text-gray-400">Pro Account</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 glass rounded-2xl flex flex-col overflow-hidden neo-brutalism">
            <div class="h-16 border-b border-white/5 flex items-center px-6">
                <h1 id="chatTitle" class="text-lg font-medium">Select a chat</h1>
            </div>

            <!-- Messages Container -->
            <div id="chatContainer" class="flex-1 overflow-y-auto chat-container">
                <div class="max-w-4xl mx-auto py-8 px-6 space-y-6">
                    <!-- Messages will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loading" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="glass p-8 rounded-2xl animate-float">
            <div class="w-12 h-12 rounded-full border-t-2 border-indigo-500 animate-spin"></div>
        </div>
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
        }

        initMarkdownParser() {
            this.md = window.markdownit({
                html: false,
                xhtmlOut: false,
                breaks: true,
                langPrefix: 'language-',
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

        showError(message) {
            console.error(message);
            this.error.textContent = message;
            this.error.classList.remove('hidden');
            setTimeout(() => this.error.classList.add('hidden'), 5000);
        }

        showLoading() { this.loading.classList.remove('hidden'); }
        hideLoading() { this.loading.classList.add('hidden'); }

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
            } finally {
                this.hideLoading();
            }
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

        renderMessage(content, isUser) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-message flex ${isUser ? 'justify-end' : 'justify-start'}`;
            
            const innerDiv = document.createElement('div');
            innerDiv.className = `max-w-3xl ${isUser ? 'bg-violet-600/10 border border-violet-600/20' : 'bg-zinc-800/60'} rounded-2xl p-6 prose prose-invert prose-p:leading-relaxed prose-pre:my-4`;

            this.md.set({
        html: true,
        breaks: true,
        linkify: true,
        typographer: true
    });

      
    // Add custom render rules
    this.md.renderer.rules.list_item_open = () => '<li class="ml-4">';
    
            
            const htmlContent = this.md.render(content);
            innerDiv.innerHTML = htmlContent;

        
            
            innerDiv.querySelectorAll('pre code').forEach(block => {
                hljs.highlightElement(block);
            });
            
            messageDiv.appendChild(innerDiv);
            this.chatContainer.appendChild(messageDiv);
        }

        addChatToList(chat) {
            const chatItem = document.createElement('div');
            chatItem.className = 'chat-item group p-3 hover:bg-zinc-800/60 rounded-lg cursor-pointer transition-all';
            chatItem.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-zinc-100 text-sm">${chat.title}</h3>
                        <p class="text-xs text-zinc-400 mt-1">${chat.date}</p>
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
            
            chatItem.addEventListener('click', () => {
                this.loadChat(chat.id, chat.title).catch(err => this.showError(err.message));
            });
            
            this.chatList.appendChild(chatItem);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        window.chatUI = new ChatUI();
    });
    </script>
</body>
</html>

