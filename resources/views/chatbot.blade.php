<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot dengan LLaMA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github-dark.min.css">
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #ccc;
        }

        /* Markdown styling */
        .markdown-body h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .markdown-body h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .markdown-body h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .markdown-body p {
            margin-bottom: 1rem;
        }

        .markdown-body ul,
        .markdown-body ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .markdown-body ul {
            list-style-type: disc;
        }

        .markdown-body ol {
            list-style-type: decimal;
        }

        .markdown-body li {
            margin-bottom: 0.25rem;
        }

        .markdown-body pre {
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .markdown-body code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 0.875rem;
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
            background-color: rgba(0, 0, 0, 0.05);
        }

        .markdown-body pre code {
            background-color: transparent;
            padding: 0;
        }

        .markdown-body blockquote {
            border-left: 4px solid #e5e7eb;
            padding-left: 1rem;
            color: #4b5563;
            margin-bottom: 1rem;
        }

        .markdown-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .markdown-body th,
        .markdown-body td {
            border: 1px solid #e5e7eb;
            padding: 0.5rem;
        }

        .markdown-body th {
            background-color: #f9fafb;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex flex-col max-w-5xl w-full mx-auto p-4 py-1">
        <a href="{{ url('/') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Back to Home
        </a>
    </div>
    <div class="flex-1 flex flex-col max-w-5xl w-full mx-auto p-4">
        <!-- Header -->
        <header class="bg-gradient-to-r from-purple-700 to-indigo-800 text-white rounded-t-xl p-4 shadow-lg">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-full">
                    <svg class="w-8 h-8 text-purple-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Chatbot LLaMA</h1>
                    <p class="text-sm text-purple-100">Asisten AI Powered by LLaMA</p>
                </div>
            </div>
        </header>

        <!-- Chat Container -->
        <div class="flex-1 bg-white rounded-b-xl shadow-lg flex flex-col">
            <!-- Chat Messages -->
            <div id="chat-messages" class="flex-1 p-4 overflow-y-auto custom-scrollbar">
                <!-- Welcome Message -->
                <div class="flex mb-4">
                    <div class="bg-purple-100 rounded-lg p-3 max-w-[80%]">
                        <div class="text-sm text-purple-800 font-semibold mb-1">LLaMA</div>
                        <div class="text-gray-800">
                            Halo! Saya adalah asisten berbasis AI yang menggunakan model LLaMA. Ada yang bisa saya bantu
                            hari ini?
                        </div>
                    </div>
                </div>

                @if (session('prompt') && session('response'))
                    <!-- User Message -->
                    <div class="flex justify-end mb-4">
                        <div class="bg-blue-100 rounded-lg p-3 max-w-[80%]">
                            <div class="text-sm text-blue-800 font-semibold mb-1">Anda</div>
                            <div class="text-gray-800">{{ session('prompt') }}</div>
                        </div>
                    </div>

                    <!-- AI Response -->
                    <div class="flex mb-4">
                        <div class="bg-purple-100 rounded-lg p-3 max-w-[80%]">
                            <div class="text-sm text-purple-800 font-semibold mb-1">LLaMA</div>
                            <div class="text-gray-800 markdown-body" id="ai-response"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Chat Input -->
            <div class="border-t p-4">
                <form id="chat-form" method="POST" action="/ask-llama" class="flex flex-col">
                    @csrf
                    <div class="relative">
                        <textarea name="prompt" id="prompt-input"
                            class="w-full border rounded-xl p-4 pr-16 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                            placeholder="Tulis pertanyaanmu..." rows="3">{{ old('prompt') }}</textarea>
                        <button type="submit"
                            class="absolute right-3 bottom-3 bg-purple-600 text-white rounded-lg p-2 hover:bg-purple-700 transition">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500 mt-2 text-center">
                        Tekan Enter untuk mengirim, Shift+Enter untuk baris baru
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Hidden textarea for markdown content -->
    @if (session('response'))
        <textarea id="markdown-content" style="display:none;">{{ session('response') }}</textarea>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Parse markdown if response exists
            const markdownContent = document.getElementById('markdown-content');
            if (markdownContent) {
                const aiResponse = document.getElementById('ai-response');
                aiResponse.innerHTML = marked.parse(markdownContent.value);

                // Apply syntax highlighting to code blocks
                document.querySelectorAll('pre code').forEach((block) => {
                    hljs.highlightElement(block);
                });

                // Scroll to bottom of chat
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Focus on input
            document.getElementById('prompt-input').focus();

            // Enter to submit, Shift+Enter for new line
            document.getElementById('prompt-input').addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('chat-form').submit();
                }
            });

            // Store chat history in session storage
            const saveMessage = (role, content) => {
                let history = JSON.parse(sessionStorage.getItem('chatHistory') || '[]');
                history.push({
                    role,
                    content
                });
                sessionStorage.setItem('chatHistory', JSON.stringify(history));
            };

            // Render existing chat history from session storage on page load
            const renderHistory = () => {
                const history = JSON.parse(sessionStorage.getItem('chatHistory') || '[]');
                const chatMessages = document.getElementById('chat-messages');

                if (history.length > 0) {
                    // Clear welcome message if we have history
                    chatMessages.innerHTML = '';

                    history.forEach(msg => {
                        let messageHTML = '';
                        if (msg.role === 'user') {
                            messageHTML = `
                                <div class="flex justify-end mb-4">
                                    <div class="bg-blue-100 rounded-lg p-3 max-w-[80%]">
                                        <div class="text-sm text-blue-800 font-semibold mb-1">Anda</div>
                                        <div class="text-gray-800">${msg.content}</div>
                                    </div>
                                </div>
                            `;
                        } else {
                            messageHTML = `
                                <div class="flex mb-4">
                                    <div class="bg-purple-100 rounded-lg p-3 max-w-[80%]">
                                        <div class="text-sm text-purple-800 font-semibold mb-1">LLaMA</div>
                                        <div class="text-gray-800 markdown-body">${marked.parse(msg.content)}</div>
                                    </div>
                                </div>
                            `;
                        }
                        chatMessages.innerHTML += messageHTML;
                    });

                    // Apply syntax highlighting to code blocks
                    document.querySelectorAll('pre code').forEach((block) => {
                        hljs.highlightElement(block);
                    });
                }
            };

            // Save current conversation to history if available
            if (markdownContent) {
                const promptContent = "{{ session('prompt') }}";
                const responseContent = markdownContent.value;

                // Only save if we're not already displaying from session storage
                if (!sessionStorage.getItem('chatHistory')) {
                    saveMessage('user', promptContent);
                    saveMessage('assistant', responseContent);
                }
            }
        });
    </script>
</body>

</html>
