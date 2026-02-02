    <div class="modal">
        <div class="modal__content">
            <button class="modal__close-btn" aria-label="Close Modal"></button>
            <h2 class="modal__title">Contact Us</h2>
           <form action="#" class="modal__form" data-ajax data-action="send_modal_form">
                <label for="name" class="modal__label">Your Name</label>
                <input type="text" id="name" name="name" class="modal__input" placeholder="Enter your name" required>

                <label for="email" class="modal__label">Your Email</label>
                <input type="email" id="email" name="email" class="modal__input" placeholder="Enter your email"
                    required>

                <label for="message" class="modal__label">Your Message</label>
                <textarea id="message" name="message" class="modal__input" placeholder="Your message"
                    required></textarea>

                <button type="submit" class="modal__submit-btn">Send</button>
            </form>
        </div>
    </div>

  