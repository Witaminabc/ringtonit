document.addEventListener('DOMContentLoaded', function () {
    // --- Contact Form ---
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData.entries());
            if (!data.name || !data.email || !data.message) {
                alert('Пожалуйста, заполните все обязательные поля.');
                return;
            }
            fetch('/wp-json/contact-form/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка при отправке формы');
                    }
                    return response.json();
                })
                .then(result => {
                    console.log('Ответ сервера:', result);
                    alert('Спасибо за ваше сообщение! Мы скоро с вами свяжемся.');
                    contactForm.reset();
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка при отправке. Пожалуйста, попробуйте позже.');
                });
        });
    }

    // --- Feedback Form ---
    const form = document.getElementById('feedbackForm');
    if (form) {
        // Маска для телефона
        const phoneInput = form.querySelector('input[type="tel"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function (e) {
                let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2]
                    ? x[1]
                    : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });
        }
        // Валидация при submit
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                const errorElement = field.closest('.form-group')?.querySelector('.form-error');
                if (!field.value.trim() || (field.type === 'checkbox' && !field.checked)) {
                    errorElement && (errorElement.textContent = 'This field is required.');
                    field.classList.add('invalid');
                    isValid = false;
                } else {
                    errorElement && (errorElement.textContent = '');
                    field.classList.remove('invalid');
                }
            });
            // Валидация email (если появится)
            const emailField = form.querySelector('input[type="email"]');
            if (emailField && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
                const errorElement = emailField.closest('.form-group')?.querySelector('.form-error');
                errorElement && (errorElement.textContent = 'Введите корректный email');
                emailField.classList.add('invalid');
                isValid = false;
            }
            if (isValid) {
                form.dispatchEvent(new Event('form-valid'));
            }
        });
        // Анимация при фокусе
        const inputs = form.querySelectorAll('.form-input, .form-textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.closest('.form-group')?.querySelector('.form-label')?.classList.add('focused');
            });
            input.addEventListener('blur', function () {
                if (!this.value) {
                    this.closest('.form-group')?.querySelector('.form-label')?.classList.remove('focused');
                }
            });
        });
    }

    // --- AJAX для модального окна ---
    const modalForm = document.querySelector('.modal__form[data-ajax][data-action="send_modal_form"]');
    if (modalForm) {
        modalForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(modalForm);
            fetch(ajaxurl, {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'send_modal_form',
                    name: formData.get('name'),
                    email: formData.get('email'),
                    message: formData.get('message')
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message || 'Message sent!');
                        modalForm.reset();
                    } else {
                        alert('Ошибка отправки!');
                    }
                })
                .catch(() => alert('Ошибка соединения!'));
        });
    }

    // --- AJAX для feedback формы ---
    const feedbackForm = document.getElementById('feedbackForm');
    if (feedbackForm) {
        feedbackForm.addEventListener('form-valid', function () {
            const formData = new FormData(feedbackForm);
            fetch(ajaxurl, {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'send_feedback_form',
                    name: formData.get('name'),
                    phone: formData.get('phone'),
                    message: formData.get('message'),
                    services: formData.get('services'),
                    agreement: formData.get('agreement')
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message || 'Спасибо! Мы свяжемся с вами.');
                        feedbackForm.reset();
                    } else {
                        alert('Ошибка отправки!');
                    }
                })
                .catch(() => alert('Ошибка соединения!'));
        });
    }
});