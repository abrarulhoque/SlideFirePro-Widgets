/**
 * Contact Page Widget JavaScript
 * Version: 1.27.0
 */

(function ($) {
    'use strict';

    /**
     * Contact Page Widget Handler
     */
    var ContactPageHandler = function ($scope, $) {
        var $contactForm = $scope.find('.slidefire-contact-form');
        var $fileInput = $scope.find('.slidefire-contact-file-input');
        var $uploadedFilesContainer = $scope.find('#slidefire-uploaded-files');
        var uploadedFiles = [];

        // Initialize
        init();

        function init() {
            bindEvents();
            updateFileUploadUI();
        }

        function bindEvents() {
            // File input change handler
            $fileInput.on('change', handleFileSelection);
            
            // Form submission handler
            $contactForm.on('submit', handleFormSubmission);
            
            // File remove handler (delegated)
            $uploadedFilesContainer.on('click', '.slidefire-contact-remove-file', handleFileRemoval);
            
            // Drag and drop handlers
            var $fileUploadArea = $scope.find('.slidefire-contact-file-upload');
            $fileUploadArea.on('dragover', handleDragOver);
            $fileUploadArea.on('dragleave', handleDragLeave);
            $fileUploadArea.on('drop', handleFileDrop);
        }

        function handleFileSelection(e) {
            var files = Array.from(e.target.files);
            processFiles(files);
        }

        function handleFileDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            
            $(e.currentTarget).removeClass('slidefire-file-drag-over');
            
            var files = Array.from(e.originalEvent.dataTransfer.files);
            processFiles(files);
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.stopPropagation();
            $(e.currentTarget).addClass('slidefire-file-drag-over');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            e.stopPropagation();
            $(e.currentTarget).removeClass('slidefire-file-drag-over');
        }

        function processFiles(files) {
            files.forEach(function (file) {
                if (isValidFile(file)) {
                    uploadedFiles.push(file);
                }
            });
            
            updateFileUploadUI();
            updateFileInput();
        }

        function isValidFile(file) {
            var allowedTypes = [
                'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp',
                'application/pdf', 'application/illustrator', 'application/postscript',
                'application/msword', 
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            
            var maxSize = 10 * 1024 * 1024; // 10MB
            
            if (!allowedTypes.includes(file.type)) {
                showError('File type not allowed: ' + file.name);
                return false;
            }
            
            if (file.size > maxSize) {
                showError('File too large: ' + file.name + '. Maximum size is 10MB.');
                return false;
            }
            
            return true;
        }

        function updateFileUploadUI() {
            if (uploadedFiles.length === 0) {
                $uploadedFilesContainer.empty().hide();
                return;
            }
            
            var html = '<label class="slidefire-contact-label">Uploaded Files:</label>';
            
            uploadedFiles.forEach(function (file, index) {
                var fileSize = (file.size / 1024 / 1024).toFixed(2);
                html += '<div class="slidefire-contact-uploaded-file">';
                html += '    <div class="slidefire-contact-uploaded-file-info">';
                html += '        <svg class="slidefire-contact-uploaded-file-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                html += '            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';
                html += '        </svg>';
                html += '        <span class="slidefire-contact-uploaded-file-name">' + escapeHtml(file.name) + '</span>';
                html += '        <span class="slidefire-contact-uploaded-file-size">(' + fileSize + ' MB)</span>';
                html += '    </div>';
                html += '    <button type="button" class="slidefire-contact-remove-file" data-index="' + index + '">';
                html += '        Remove';
                html += '    </button>';
                html += '</div>';
            });
            
            $uploadedFilesContainer.html(html).show();
        }

        function updateFileInput() {
            // Create a new DataTransfer object to update the file input
            var dt = new DataTransfer();
            uploadedFiles.forEach(function (file) {
                dt.items.add(file);
            });
            $fileInput[0].files = dt.files;
        }

        function handleFileRemoval(e) {
            e.preventDefault();
            var index = parseInt($(e.currentTarget).data('index'));
            uploadedFiles.splice(index, 1);
            updateFileUploadUI();
            updateFileInput();
        }

        function handleFormSubmission(e) {
            // Let the form submit normally for server-side processing
            // Add loading state to submit button
            var $submitBtn = $contactForm.find('.slidefire-contact-btn');
            $submitBtn.prop('disabled', true).html(
                '<svg class="slidefire-contact-btn-icon animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>' +
                '</svg>' +
                'Sending...'
            );
        }

        function showError(message) {
            // Create or update error message
            var $errorContainer = $scope.find('.slidefire-contact-file-error');
            if ($errorContainer.length === 0) {
                $errorContainer = $('<div class="slidefire-contact-file-error"></div>');
                $scope.find('.slidefire-contact-file-upload').after($errorContainer);
            }
            
            $errorContainer.html(message).show();
            
            // Auto-hide after 5 seconds
            setTimeout(function () {
                $errorContainer.fadeOut();
            }, 5000);
        }

        function escapeHtml(text) {
            var div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    };

    // Register the handler with Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/slidefire_contact_page.default', ContactPageHandler);
    });

})(jQuery);

// Add CSS for drag and drop states and animations
var contactPageCSS = `
    .slidefire-file-drag-over {
        border-color: var(--slidefire-primary) !important;
        background-color: rgba(35, 178, 238, 0.05);
    }
    
    .slidefire-contact-file-error {
        background-color: rgba(255, 51, 102, 0.1);
        border: 1px solid rgba(255, 51, 102, 0.3);
        color: var(--slidefire-destructive);
        padding: 0.75rem;
        border-radius: 0.375rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        display: none;
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
`;

// Inject CSS
var style = document.createElement('style');
style.textContent = contactPageCSS;
document.head.appendChild(style);