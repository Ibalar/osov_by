// AJAX handler for telegram forms
$(document).ready(function () {
    const $forms = $('form.js-telegram-form');

    if (!$forms.length) {
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $forms.on('submit', function (event) {
        event.preventDefault();

        const $form = $(this);
        const $button = $form.find('button[type="submit"]');
        const originalButtonText = $button.text();

        let isValid = true;
        $form.find('.required').each(function () {
            const $field = $(this);

            if ($field.attr('type') === 'checkbox') {
                if (!$field.is(':checked')) {
                    isValid = false;
                }
                return;
            }

            if (!$field.val() || $field.val() === '0') {
                isValid = false;
            }
        });

        if (!isValid) {
            alert('Пожалуйста, заполните все обязательные поля.');
            return;
        }

        $button.prop('disabled', true).text('Отправка...');

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const $fields = $form.find('.form__fields');
                    const $success = $form.find('.form__success');

                    if ($fields.length) {
                        $fields.hide();
                    }

                    if ($success.length) {
                        $success.show();
                    } else if ($form.find('.form-block__success').length === 0) {
                        const successHtml = `
                            <div class="form-block__success" style="text-align: center; padding: 20px;">
                                <div style="font-size: 48px; margin-bottom: 16px;">✅</div>
                                <h3 style="color: #28a745; margin-bottom: 12px;">${response.message || 'Спасибо! Ваша заявка принята.'}</h3>
                                <p style="color: #666;">Мы свяжемся с вами в ближайшее время.</p>
                            </div>
                        `;
                        $form.append(successHtml);
                    }

                    $form[0].reset();
                } else {
                    alert(response.message || 'Произошла ошибка. Пожалуйста, попробуйте еще раз.');
                }
            },
            error: function (xhr) {
                let message = 'Произошла ошибка. Пожалуйста, попробуйте еще раз.';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = Object.values(xhr.responseJSON.errors).flat();
                    message = errors.join('\n');
                }

                alert(message);
            },
            complete: function () {
                $button.prop('disabled', false).text(originalButtonText);
            }
        });
    });
});
