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
            <div class="p-4 border-b border-zinc-800/80 space-y-2">
                <button class="w-full bg-zinc-800 hover:bg-zinc-700 text-white rounded-lg py-3 px-4 font-medium transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Chat
                </button>
                <div class="flex gap-2">
                    <button id="collapseAll" class="flex-1 bg-zinc-800 hover:bg-zinc-700 text-white rounded-lg py-2 px-3 text-sm font-medium transition-colors">
                        Collapse All
                    </button>
                    <button id="expandAll" class="flex-1 bg-zinc-800 hover:bg-zinc-700 text-white rounded-lg py-2 px-3 text-sm font-medium transition-colors">
                        Expand All
                    </button>
                </div>
            </div>
            <div class="p-4 border-b border-zinc-800/80">
                <input type="text" id="searchInput" placeholder="Search chats..." class="w-full bg-zinc-800 text-white rounded-lg py-2 px-4">
                <div id="tagInput" class="mt-2 flex flex-wrap gap-2">
                    <!-- Tags will be inserted here -->
                </div>
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
                this.newChatButton = document.querySelector('button');
                this.searchInput = document.getElementById('searchInput');
                this.tagInput = document.getElementById('tagInput');

                this.collapseAllBtn = document.getElementById('collapseAll');
                this.expandAllBtn = document.getElementById('expandAll');


                this.initMarkdown();
                this.initEventListeners();
                this.loadChats();

                this.addScrollButton();



            }

            initEventListeners() {
                this.newChatButton.addEventListener('click', () => {
                    console.log('New chat clicked');
                });

                this.searchInput.addEventListener('input', () => {
                    this.filterChats(this.searchInput.value);
                });

                this.collapseAllBtn.addEventListener('click', () => this.toggleAllFolders(true));
                this.expandAllBtn.addEventListener('click', () => this.toggleAllFolders(false));

                // Initialize folder state
                this.folderStates = new Map();
            }

            async toggleAllFolders(collapse) {
                const folders = document.querySelectorAll('.folder-item');
                folders.forEach(folder => {
                    const content = folder.querySelector('div:nth-child(2)');
                    const arrow = folder.querySelector('svg:first-child');
                    if (content && arrow) {
                        if (collapse) {
                            content.classList.add('hidden');
                            arrow.classList.add('-rotate-90');
                        } else {
                            content.classList.remove('hidden');
                            arrow.classList.remove('-rotate-90');
                        }
                    }
                });

                // Update folder states in backend
                try {
                    const folderIds = Array.from(folders).map(folder => {
                        const id = folder.id.replace('folder-', '');
                        return id;
                    });

                    for (const id of folderIds) {
                        await fetch(`api.php?action=toggleFolder&id=${id}&state=${collapse ? '1' : '0'}`);
                    }
                } catch (error) {
                    console.error('Failed to update folder states:', error);
                }
            }

            async toggleFolder(folderId) {
                try {
                    const folder = document.getElementById(`folder-${folderId}`);
                    const arrow = folder.previousElementSibling.querySelector('svg:first-child');
                    const content = folder;

                    if (content && arrow) {
                        const isCollapsed = content.classList.toggle('hidden');
                        arrow.classList.toggle('-rotate-90', isCollapsed);
                        await fetch(`api.php?action=toggleFolder&id=${folderId}`);
                    }
                } catch (error) {
                    console.error('Failed to toggle folder:', error);
                }
            }

            filterChats(query) {
                query = query.toLowerCase();

                // Helper function to show element and all its parents
                const showElementAndParents = (element) => {
                    element.style.display = '';
                    if (element.classList.contains('folder-item')) {
                        const contentDiv = element.querySelector('div:nth-child(2)');
                        if (contentDiv) {
                            contentDiv.classList.remove('hidden');
                        }
                    }
                    let parent = element.parentElement;
                    while (parent) {
                        if (parent.classList.contains('folder-item')) {
                            parent.style.display = '';
                            const parentContent = parent.querySelector('div:nth-child(2)');
                            if (parentContent) {
                                parentContent.classList.remove('hidden');
                            }
                        }
                        parent = parent.parentElement;
                    }
                };

                // Helper function to show all children of a folder
                const showAllChildren = (folderElement) => {
                    const allChildren = folderElement.querySelectorAll('.chat-item, .folder-item');
                    allChildren.forEach(child => {
                        child.style.display = '';
                        if (child.classList.contains('folder-item')) {
                            const contentDiv = child.querySelector('div:nth-child(2)');
                            if (contentDiv) {
                                contentDiv.classList.remove('hidden');
                            }
                        }
                    });
                };

                // First hide everything
                const allItems = document.querySelectorAll('.chat-item, .folder-item');
                allItems.forEach(item => {
                    item.style.display = 'none';
                });

                // Then show matching items and their related elements
                allItems.forEach(item => {
                    let matches = false;

                    if (item.classList.contains('folder-item')) {
                        // Check folder name
                        const folderTitle = item.querySelector('div:first-child').textContent.toLowerCase();
                        if (folderTitle.includes(query)) {
                            matches = true;
                            // If folder matches, show the folder and all its contents
                            showElementAndParents(item);
                            showAllChildren(item);
                        }
                    } else if (item.classList.contains('chat-item')) {
                        // Check chat item title and tags
                        const title = item.querySelector('h3')?.textContent.toLowerCase() || '';
                        const tags = item.getAttribute('data-tags')?.toLowerCase() || '';
                        if (title.includes(query) || tags.includes(query)) {
                            matches = true;
                            showElementAndParents(item);
                        }
                    }

                    if (matches) {
                        // No additional logic needed here as showElementAndParents handles it
                        // This is just a placeholder for any future matching-specific logic
                    }
                });
            }


            async showTagEditor(item) {
                const tags = item.tags || [];
                const tagsInput = prompt('Enter tags (comma separated):', tags.join(', '));

                if (tagsInput !== null) {
                    const newTags = tagsInput.split(',')
                        .map(tag => tag.trim())
                        .filter(tag => tag.length > 0);

                    await fetch(`api.php?action=setTags&id=${item.id}`, {
                        method: 'POST',
                        body: JSON.stringify({
                            tags: newTags
                        })
                    });

                    await this.loadChats();
                }
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
                    const result = await response.json();

                    if (!result.success || !result.data) {
                        throw new Error('Invalid response format');
                    }

                    this.chatList.innerHTML = '';
                    if (Array.isArray(result.data)) {
                        const sortedData = this.sortItems(result.data);
                        sortedData.forEach(item => {
                            if (item.type === 'folder') {
                                item.collapsed = true; // Set initial state to collapsed
                                if (item.items) {
                                    item.items = this.sortItems(item.items);
                                }
                            }
                            const itemElement = this.createChatListItem(item);
                            if (itemElement) {
                                this.chatList.appendChild(itemElement);
                            }
                        });
                    }
                } catch (error) {
                    console.error('Failed to load chats:', error);
                } finally {
                    this.hideLoading();
                }
            }

            sortItems(items) {
                // Sort files first, then folders
                return items.sort((a, b) => {
                    // First sort by type (files before folders)
                    if (a.type !== b.type) {
                        return a.type === 'file' ? -1 : 1;
                    }
                    // Then by pinned status
                    if (a.pinned !== b.pinned) {
                        return a.pinned ? -1 : 1;
                    }
                    // Finally by title
                    return a.title.localeCompare(b.title);
                });
            }

            async toggleFolder(folderId) {
                try {
                    const folderItem = document.querySelector(`[data-folder-id="${folderId}"]`);
                    if (!folderItem) return;

                    const content = folderItem.querySelector('.folder-content');
                    const arrow = folderItem.querySelector('.folder-arrow');

                    if (content && arrow) {
                        const isCollapsed = content.classList.toggle('hidden');
                        arrow.classList.toggle('-rotate-90', isCollapsed);
                        await fetch(`api.php?action=toggleFolder&id=${folderId}`);
                    }
                } catch (error) {
                    console.error('Failed to toggle folder:', error);
                }
            }

            createChatListItem(item, level = 0) {
    if (!item) return null;

    const itemDiv = document.createElement('div');

    if (item.type === 'folder') {
        // Create folder container
        itemDiv.className = `folder-item ml-${level * 4}`;
        
        // Create folder header
        const headerDiv = document.createElement('div');
        headerDiv.className = 'flex items-center p-2 text-zinc-400 text-sm hover:bg-zinc-800/60 rounded-lg cursor-pointer';
        headerDiv.innerHTML = `
            <svg class="w-4 h-4 mr-2 transform transition-transform ${item.collapsed ? '-rotate-90' : ''}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            </svg>
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
            </svg>
            ${item.title}
            ${item.pinned ? '<svg class="w-4 h-4 ml-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>' : ''}
        `;
        
        // Create folder content
        const contentDiv = document.createElement('div');
        contentDiv.className = `ml-4 ${item.collapsed ? 'hidden' : ''}`;
        
        // Add folder items
        if (item.items) {
            item.items.forEach(subItem => {
                const subElement = this.createChatListItem(subItem, level + 1);
                if (subElement) {
                    contentDiv.appendChild(subElement);
                }
            });
        }
        
        // Add click handler
        headerDiv.addEventListener('click', (e) => {
            e.stopPropagation();
            const arrow = headerDiv.querySelector('svg:first-child');
            const isCollapsed = !contentDiv.classList.contains('hidden');
            
            contentDiv.classList.toggle('hidden', isCollapsed);
            arrow.classList.toggle('-rotate-90', isCollapsed);
            
            fetch(`api.php?action=toggleFolder&id=${item.id}`).catch(error => {
                console.error('Failed to toggle folder:', error);
            });
        });
        
        itemDiv.appendChild(headerDiv);
        itemDiv.appendChild(contentDiv);

    } else {
        // Chat item code remains the same
        itemDiv.className = `chat-item group p-3 hover:bg-zinc-800/60 rounded-lg cursor-pointer transition-all ml-${level * 4} ${item.pinned ? 'border-l-2 border-yellow-500' : ''}`;
        itemDiv.setAttribute('data-tags', item.tags ? item.tags.join(' ') : '');
        itemDiv.innerHTML = `
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center">
                        <h3 class="font-medium text-zinc-100 text-sm">${item.title}</h3>
                        ${item.pinned ? '<svg class="w-4 h-4 ml-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>' : ''}
                    </div>
                    <p class="text-xs text-zinc-400 mt-1">${item.date}</p>
                    ${item.tags && item.tags.length ? `
                        <div class="flex gap-1 mt-1">
                            ${item.tags.map(tag => `<span class="text-xs bg-zinc-700 px-1 rounded">${tag}</span>`).join('')}
                        </div>
                    ` : ''}
                </div>
                <div class="chat-item-icons opacity-0 transition-opacity flex gap-2">
                    <button class="tag-button p-1 hover:bg-zinc-700 rounded" title="Edit tags">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M7 7h.01M7 3h5l7 7-7 7-7-7V7a4 4 0 014-4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg>
                    </button>
                    <button class="action-button p-1 hover:bg-zinc-700 rounded">
                        <svg class="w-4 h-4 ${item.pinned ? 'text-yellow-500' : 'text-zinc-400'}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                        </svg>
                    </button>
                </div>
            </div>
        `;

        // Add chat item event listeners
        const pinButton = itemDiv.querySelector('.action-button');
        const tagButton = itemDiv.querySelector('.tag-button');
        
        pinButton.addEventListener('click', (e) => {
            e.stopPropagation();
            this.togglePin(item.id);
        });

        tagButton.addEventListener('click', (e) => {
            e.stopPropagation();
            this.editTags(item);
        });

        itemDiv.addEventListener('click', () => this.loadChat(item.id, item.title));
    }

    return itemDiv;
}



            async editTags(item) {
                const currentTags = item.tags || [];
                const input = prompt('Enter tags (comma separated):', currentTags.join(', '));

                if (input !== null) {
                    const newTags = input.split(',').map(t => t.trim()).filter(t => t);
                    try {
                        const response = await fetch(`api.php?action=setTags&id=${item.id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                tags: newTags
                            })
                        });

                        if (response.ok) {
                            await this.loadChats();
                        }
                    } catch (error) {
                        console.error('Failed to update tags:', error);
                    }
                }
            }

            async togglePin(id) {
                try {
                    await fetch(`api.php?action=togglePin&id=${id}`);
                    await this.loadChats();
                } catch (error) {
                    console.error('Failed to toggle pin:', error);
                }
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
                        // this.scrollToBottom();

                    }
                } catch (error) {
                    console.error('Failed to load chat:', error);
                } finally {
                    this.hideLoading();
                }
            }

            renderMessage(content, isUser) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `chat-message flex ${isUser ? 'justify-end' : 'justify-start'} mb-4`;

                const wrapperDiv = document.createElement('div');
                wrapperDiv.className = 'message-wrapper relative max-w-3xl';

                const innerDiv = document.createElement('div');
                innerDiv.className = `z-20 ${isUser ? 'bg-gray-500/10 border border-gray-500/20' : 'bg-zinc-800/60'} rounded-2xl p-6 prose prose-invert prose-p:leading-relaxed prose-pre:my-4`;

                const htmlContent = this.md.render(content);
                innerDiv.innerHTML = htmlContent;

                wrapperDiv.appendChild(innerDiv);
                messageDiv.appendChild(wrapperDiv);
                this.chatContainer.appendChild(messageDiv);

                // Highlight code blocks
                messageDiv.querySelectorAll('pre code').forEach(block => {
                    hljs.highlightElement(block);
                });
            }

            // scrollToBottom() {
            //     const container = this.chatContainer.parentElement;
            //     container.scrollTop = container.scrollHeight;
            // }


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
        }

        // Initialize UI
        document.addEventListener('DOMContentLoaded', () => {
            window.chatUI = new ChatUI();
        });
    </script>
</body>

</html>