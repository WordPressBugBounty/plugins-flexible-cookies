jQuery(function () {
    if (jQuery('.mgr_hide_if_checked').is(':checked')) {
        hideField('hide_if_checked');
    } else {
        showField('hide_if_checked');
    }
    if (jQuery('.mgr_hide_if_not_checked').is(':not(:checked)')) {
        hideField('hide_if_not_checked');
    } else {
        showField('hide_if_not_checked');
    }
})

function hideField(field_class) {
    jQuery('.' + field_class).closest('tr').hide();
}

function showField(field_class) {
    jQuery('.' + field_class).closest('tr').show();
}

jQuery('.mgr_hide_if_not_checked').on('change', function () {
    if (jQuery(this).is(':not(:checked)')) {
        hideField('hide_if_not_checked');
    } else {
        showField('hide_if_not_checked');
    }
})

jQuery('.mgr_hide_if_checked').on('change', function () {
    if (jQuery(this).is(':checked')) {
        hideField('hide_if_checked');
    } else {
        showField('hide_if_checked');
    }
})

jQuery('.select_all_cookies').on('change', function () {
    jQuery(".cookie_checkbox").prop('checked', this.checked);
});
