class ChatViewer {
    constructor() {
        this.chatContainer = document.getElementById('chat-container');
        this.loadChats();
    }

    async loadChats() {
        try {
            const response = await fetch('api/parse.php');
            if (!response.ok) throw new Error('Network response was not ok');
            
            const data = await response.json();
            this.renderChats(data);
        } catch (error) {
            this.renderError('Failed to load chat data: ' + error.message);
        }
    }

    renderChats(data) {
        data.forEach(file => this.renderFile(file));
        this.initializeSyntaxHighlighting();
    }

    renderFile(file) {
        const fileDiv = document.createElement('div');
        fileDiv.className = 'chat-file';
        
        const fileHeader = this.createFileHeader(file);
        fileDiv.appendChild(fileHeader);
        
        file.sections.forEach(section => {
            const messageDiv = this.createMessageDiv(section);
            fileDiv.appendChild(messageDiv);
        });
        
        this.chatContainer.appendChild(fileDiv);
    }

    createFileHeader(file) {
        const header = document.createElement('div');
        header.className = 'file-header';
        
        const fileName = document.createElement('h2');
        fileName.textContent = file.filename;
        
        const metadata = document.createElement('div');
        metadata.className = 'metadata';
        metadata.textContent = `Last modified: ${file.modified}`;
        
        header.appendChild(fileName);
        header.appendChild(metadata);
        return header;
    }

    createMessageDiv(section) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${section.type}`;
        
        const header = document.createElement('div');
        header.className = 'message-header';
        header.textContent = section.type === 'prompt' ? 'Human:' : 'Assistant:';
        
        const content = document.createElement('div');
        content.className = 'message-content';
        content.innerHTML = marked(section.content, {
            highlight: (code, lang) => {
                if (Prism.languages[lang]) {
                    return Prism.highlight(code, Prism.languages[lang], lang);
                }
                return code;
            }
        });
        
        messageDiv.appendChild(header);
        messageDiv.appendChild(content);
        return messageDiv;
    }

    renderError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error';
        errorDiv.textContent = message;
        this.chatContainer.appendChild(errorDiv);
    }

    initializeSyntaxHighlighting() {
        Prism.highlightAll();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ChatViewer();
});