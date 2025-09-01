jQuery(document).ready(function($) {
    'use strict';

    // Features repeater functionality
    let featureIndex = $('.slidefire-repeater-item').length;

    // Add new feature item
    $(document).on('click', '.add-feature-item', function(e) {
        e.preventDefault();
        
        const newItem = $('<div class="slidefire-repeater-item" data-index="' + featureIndex + '">' +
            '<input type="text" name="slidefire_product_features[' + featureIndex + ']" ' +
            'value="" placeholder="Enter feature description" style="width: 90%;" />' +
            '<button type="button" class="button remove-item" style="margin-left: 5px;">Remove</button>' +
            '</div>');
        
        $('#slidefire-features-repeater .slidefire-repeater-items').append(newItem);
        featureIndex++;
    });

    // Remove feature item
    $(document).on('click', '#slidefire-features-repeater .remove-item', function(e) {
        e.preventDefault();
        $(this).closest('.slidefire-repeater-item').remove();
    });

    // Specifications repeater functionality
    let specIndex = $('#slidefire-specifications-repeater .slidefire-repeater-item').length;

    // Add new specification item
    $(document).on('click', '.add-specification-item', function(e) {
        e.preventDefault();
        
        const newItem = $('<div class="slidefire-repeater-item" data-index="' + specIndex + '" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center;">' +
            '<input type="text" name="slidefire_product_specifications[' + specIndex + '][name]" ' +
            'value="" placeholder="Specification name (e.g., Origin)" style="width: 40%;" />' +
            '<input type="text" name="slidefire_product_specifications[' + specIndex + '][value]" ' +
            'value="" placeholder="Specification value (e.g., Designed in USA)" style="width: 40%;" />' +
            '<button type="button" class="button remove-item">Remove</button>' +
            '</div>');
        
        $('#slidefire-specifications-repeater .slidefire-repeater-items').append(newItem);
        specIndex++;
    });

    // Remove specification item
    $(document).on('click', '#slidefire-specifications-repeater .remove-item', function(e) {
        e.preventDefault();
        $(this).closest('.slidefire-repeater-item').remove();
    });

    // Prevent removing the last item if it's the only one
    $(document).on('click', '.remove-item', function(e) {
        const container = $(this).closest('.slidefire-repeater-items');
        const items = container.find('.slidefire-repeater-item');
        
        if (items.length === 1) {
            // Don't remove the last item, just clear its values
            $(this).closest('.slidefire-repeater-item').find('input').val('');
            e.preventDefault();
            return false;
        }
    });
});