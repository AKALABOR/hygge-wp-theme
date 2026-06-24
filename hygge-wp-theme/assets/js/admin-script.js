jQuery(document).ready(function($) {
    // For each meta box that belongs to our theme
    $('.postbox[id^="hygge_"]').each(function() {
        var $metabox = $(this);
        var $content = $metabox.find('.inside');
        
        // Find all h3 tags (these are our section headers)
        var $headers = $content.find('h3');
        if ($headers.length === 0) return; // No sections, skip
        
        // Create tabs container and content wrapper
        var $tabsContainer = $('<div class="hygge-admin-tabs"></div>');
        var $tabsWrapper = $('<div class="hygge-tabs-wrapper"></div>');
        $content.prepend($tabsWrapper);
        $content.prepend($tabsContainer);
        
        // Wrap everything before the first h3 into a "General" tab
        var $firstHeader = $headers.first();
        var $generalElements = $firstHeader.prevAll().not('.hygge-admin-tabs').not('.hygge-tabs-wrapper');
        
        var boxId = $metabox.attr('id') || 'hygge-meta';
        var tabIndex = 0;
        
        if ($generalElements.length > 0) {
            var $generalTabBtn = $('<button type="button" class="hygge-admin-tab-btn active" data-tab="' + boxId + '-tab-0">Загальне</button>');
            $tabsContainer.append($generalTabBtn);
            
            var $generalContent = $('<div class="hygge-tab-content active" id="' + boxId + '-tab-0"></div>');
            // Reverse is needed because prevAll() returns elements in reverse order
            $($generalElements.get().reverse()).appendTo($generalContent);
            $tabsWrapper.append($generalContent);
            tabIndex++;
        }
        
        // Now process each h3 and its following elements until the next h3
        $headers.each(function() {
            var $header = $(this);
            var title = $header.text();
            
            // Remove hr if it exists before h3
            var $prevHr = $header.prev('hr');
            if ($prevHr.length) $prevHr.remove();
            
            // Create tab button
            var isActive = tabIndex === 0 ? 'active' : '';
            var $tabBtn = $('<button type="button" class="hygge-admin-tab-btn ' + isActive + '" data-tab="' + boxId + '-tab-' + tabIndex + '">' + title + '</button>');
            $tabsContainer.append($tabBtn);
            
            // Create tab content wrapper
            var $tabContent = $('<div class="hygge-tab-content ' + isActive + '" id="' + boxId + '-tab-' + tabIndex + '"></div>');
            
            // Move elements into the tab content
            var $nextElements = $header.nextUntil('h3');
            $nextElements.appendTo($tabContent);
            $header.remove(); // Remove the h3 itself
            
            $tabsWrapper.append($tabContent);
            tabIndex++;
        });
        
        // Tab click event
        $tabsContainer.on('click', '.hygge-admin-tab-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var targetId = $btn.data('tab');
            
            // Update buttons
            $btn.siblings().removeClass('active');
            $btn.addClass('active');
            
            // Update content
            var $box = $btn.closest('.inside');
            $box.find('.hygge-tab-content').removeClass('active');
            $box.find('#' + targetId).addClass('active');
        });
    });

    // Repeater Logic
    $(document).on('click', '.hygge-add-row', function(e) {
        e.preventDefault();
        var $repeater = $(this).closest('.hygge-repeater');
        var $rows = $repeater.find('.hygge-repeater-row');
        if ($rows.length === 0) return;
        
        var $lastRow = $rows.last();
        var $countField = $repeater.find('.repeater-count');
        var count = parseInt($countField.val() || 0, 10);
        
        var newIndex = count + 1;
        var $newRow = $lastRow.clone();
        
        // Update names, ids, and values
        var prefix = $repeater.data('prefix'); // e.g. sap_mod
        var regex = new RegExp('(' + prefix + ')\\d+(_.*)?');
        
        $newRow.find('[name]').each(function() {
            var name = $(this).attr('name');
            if (name) {
                $(this).attr('name', name.replace(regex, '$1' + newIndex + '$2'));
            }
            var id = $(this).attr('id');
            if (id) {
                $(this).attr('id', id.replace(regex, '$1' + newIndex + '$2'));
            }
            $(this).val(''); // Clear value
        });
        
        // Update labels (e.g. "Модуль 4: Заголовок" -> "Модуль 5: Заголовок")
        $newRow.find('label').each(function() {
            var $label = $(this);
            var text = $label.text();
            $label.text(text.replace(/\d+/, newIndex));
            
            var forAttr = $label.attr('for');
            if (forAttr) {
                $label.attr('for', forAttr.replace(regex, '$1' + newIndex + '$2'));
            }
        });
        
        $lastRow.after($newRow);
        $countField.val(newIndex);
    });

    $(document).on('click', '.hygge-remove-row', function(e) {
        e.preventDefault();
        var $row = $(this).closest('.hygge-repeater-row');
        var $repeater = $row.closest('.hygge-repeater');
        
        if ($repeater.find('.hygge-repeater-row').length > 1) {
            if (confirm('Ви впевнені, що хочете видалити цей рядок? Дані будуть втрачені.')) {
                $row.remove();
            }
        } else {
            alert('Не можна видалити останній рядок.');
        }
    });

});
