console.log('Hello JS');

document.addEventListener('DOMContentLoaded', function() {
    // Общие элементы
    const header = document.querySelector('.header');
    const headerFixed = document.querySelector('.header__fixed');
    const introImage = document.querySelector('.intro__image-content');
    const projectItems = document.querySelectorAll(".projects__container");
    const projectsContainer = document.querySelector(".projects__list");
    
    // Проверяем элементы для хедера
    if (header && headerFixed) {
        let lastScrollY = window.scrollY;
        let ticking = false;
        const fixedHeaderHeight = headerFixed.offsetHeight;

        const updateHeaderHeight = () => {
            header.style.height = `${fixedHeaderHeight}px`;
        };

        const handleScroll = () => {
            const currentScrollY = window.scrollY;

            if (currentScrollY === 0) {
                headerFixed.classList.remove('active');
            } else if (currentScrollY > lastScrollY && currentScrollY > 50) {
                headerFixed.classList.add('active');
            } else if (currentScrollY < lastScrollY) {
                headerFixed.classList.remove('active');
            }

            lastScrollY = currentScrollY;
        };

        // Обработка admin bar в WordPress
        if (document.body.classList.contains('admin-bar')) {
            const wpAdminBar = document.getElementById('wpadminbar');
            
            if (wpAdminBar) {
                function updateHeaderPadding() {
                    const adminBarHeight = wpAdminBar.offsetHeight;
                    headerFixed.style.paddingTop = window.innerWidth > 768 ? `${adminBarHeight}px` : '0';
                }
                
                updateHeaderPadding();
                window.addEventListener('resize', updateHeaderPadding);
            }
        }

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
        window.addEventListener('resize', updateHeaderHeight);
        updateHeaderHeight();
    }

    // Параллакс для intro image
    if (introImage) {
        const handleIntroParallax = () => {
            const scrollY = window.scrollY;
            const introImageRect = introImage.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            if (introImageRect.top < windowHeight && introImageRect.bottom > 0) {
                introImage.style.transform = `translateY(${scrollY * 0.2}px)`;
            }
        };
        window.addEventListener('scroll', handleIntroParallax);
    }

    // Параллакс для проектов
    if (projectItems.length && projectsContainer) {
        const handleProjectParallax = () => {
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;
            const fixedHeaderHeight = headerFixed ? headerFixed.offsetHeight : 0;

            if (windowWidth < 768) {
                projectItems.forEach(item => {
                    const content = item.querySelector(".projects__box");
                    if (content) content.style.transform = '';
                });
                return;
            }

            projectItems.forEach(item => {
                const content = item.querySelector(".projects__box");
                const meta = item.querySelector(".projects__meta");
                const itemRect = item.getBoundingClientRect();

                if (itemRect.top < windowHeight && itemRect.bottom > 0) {
                    const adjustedBottom = itemRect.bottom - fixedHeaderHeight;
                    const progress = Math.min(1, Math.max(0, 1 - adjustedBottom / windowHeight));
                    const maxOffset = item.clientHeight - content.clientHeight;
                    const metaHeight = meta ? meta.clientHeight : 0;
                    const adjustedMaxOffset = Math.max(0, maxOffset - metaHeight);
                    const factor = 1.2;
                    const translateY = Math.min(adjustedMaxOffset, adjustedMaxOffset * progress * factor);

                    content.style.transform = `translateY(${translateY}px)`;
                }
            });
        };

        window.addEventListener("scroll", handleProjectParallax);
        window.addEventListener("resize", handleProjectParallax);
        handleProjectParallax();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const imageCol = document.querySelector('.category-heading__desc-col--image');
    const textCol = document.querySelector('.category-heading__desc-col--text');
    const parallaxImg = document.querySelector('.parallax-image img');
    
    if (!imageCol || !textCol || !parallaxImg) return;
    
    // Параллакс для десктопа
    function handleParallax() {
        if (window.innerWidth < 768) return;
        
        const scrollY = window.scrollY;
        const speedFactor = 0.2;
        parallaxImg.style.transform = `translateY(${scrollY * speedFactor}px)`;
    }
    
    // Мобильный layout
    function setupMobileLayout() {
        if (window.innerWidth >= 768) return;
        
        const img = imageCol.querySelector('img');
        if (!img) return;
        
        if (!textCol.querySelector('.mobile-bg')) {
            textCol.insertAdjacentHTML('afterbegin', `
                <div class="mobile-bg"></div>
                <div class="mobile-overlay"></div>
            `);
            textCol.querySelector('.mobile-bg').style.backgroundImage = `url(${img.src})`;
        }
        imageCol.style.display = 'none';
    }
    
    function cleanupMobileLayout() {
        const bg = textCol.querySelector('.mobile-bg');
        const overlay = textCol.querySelector('.mobile-overlay');
        
        if (bg) bg.remove();
        if (overlay) overlay.remove();
        
        imageCol.style.display = '';
        parallaxImg.style.transform = '';
    }
    
    function handleResize() {
        if (window.innerWidth < 768) {
            setupMobileLayout();
        } else {
            cleanupMobileLayout();
        }
    }
    
    // Инициализация
    handleResize();
    window.addEventListener('resize', handleResize);
    window.addEventListener('scroll', handleParallax);
});



document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");

    // Функция для анимации счетчика и прогресс-бара
    const animateCounter = (counter) => {
        const target = +counter.getAttribute("data-target"); // Целевое значение
        const duration = 2000; // Длительность анимации
        const startTime = performance.now();

        // Находим соответствующий прогресс-бар
        const progressBar = counter.closest("p").nextElementSibling.querySelector(".progress");

        const updateCounter = (currentTime) => {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1); // Прогресс от 0 до 1
            const value = Math.floor(progress * target); // Текущее значение

            counter.textContent = value; // Обновляем текст счетчика
            progressBar.style.width = `${progress * 100}%`; // Обновляем ширину прогресс-бара

            if (progress < 1) {
                requestAnimationFrame(updateCounter); // Продолжаем анимацию
            }
        };

        requestAnimationFrame(updateCounter);
    };

    // Настройки для Intersection Observer
    const options = {
        root: null, // Используем viewport как область отслеживания
        rootMargin: "0px", // Без отступов
        threshold: 0.5, // Запускать анимацию, когда 50% элемента видно
    };

    // Создаем Intersection Observer
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Если элемент виден, запускаем анимацию для всех счетчиков
                counters.forEach((counter) => {
                    animateCounter(counter);
                });
                observer.disconnect(); // Останавливаем наблюдение после запуска анимации
            }
        });
    }, options);

    // Наблюдаем за блоком, содержащим счетчики
    const aboutSection = document.querySelector(".about");
    if (aboutSection) {
        observer.observe(aboutSection);
    }
});

document.addEventListener("DOMContentLoaded", () => {
    // Удаляем все активные классы сначала
    document.querySelectorAll('.header__nav-item.active, .header__nav-item-link.active').forEach(el => {
        el.classList.remove('active');
    });
    
    // Находим текущий пункт по aria-current
    const currentLink = document.querySelector('.header__nav-item-link[aria-current="page"]');
    if (currentLink) {
        currentLink.classList.add('active');
        currentLink.closest('.header__nav-item').classList.add('active');
    }
});
document.addEventListener("DOMContentLoaded", () =>{
    const headerButton = document.querySelector('.header__actions-btn');
    const openModal = document.querySelector('.modal');
    const closeModal = document.querySelector('.modal__close-btn')
    if (headerButton && openModal) {
        headerButton.addEventListener('click', () => {
            openModal.classList.add('active');
        });
    }

    if (closeModal && openModal) {
        closeModal.addEventListener('click', () => {
            openModal.classList.remove('active');
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const headerMenuBurger = document.querySelector('.header__burger-menu');
    const headerMenuLines = document.querySelectorAll('.header__burger-line');
    const headerMenuList = document.querySelector('.header__nav');
    const headerButton = document.querySelector('.header__actions-btn');
    const headerActions = document.querySelector('.header__actions');
    const headerLogo = document.querySelector('.header__logo');

    // Клонируем логотип один раз при загрузке страницы
    const headerLogoClone = headerLogo.cloneNode(true);

    headerMenuBurger.addEventListener('click', () => {
        // Если меню открыто (есть класс 'active'), удаляем кнопку и логотип
        if (headerMenuList.classList.contains('active')) {
            headerMenuList.removeChild(headerButton);
            headerMenuList.removeChild(headerLogoClone);

            // Возвращаем кнопку в headerActions (вторым элементом)
            const secondChild = headerActions.children[1]; // Второй дочерний элемент
            headerActions.insertBefore(headerButton, secondChild);
        }
        // Если меню закрыто (нет класса 'active'), добавляем кнопку и логотип
        else {
            headerMenuList.appendChild(headerButton);
            headerMenuList.appendChild(headerLogoClone);
        }

        // Переключаем классы
        headerMenuList.classList.toggle('active');
        headerMenuBurger.classList.toggle('active');
        headerMenuLines.forEach(line => {
            line.classList.toggle('active');
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const itemHeaders = document.querySelectorAll('.services__item-header');
    const itemsContent = document.querySelectorAll('.services__item-content');

    itemHeaders.forEach((header, index) => {
        header.addEventListener('click', () => {
            itemHeaders.forEach(content => {
                content.classList.remove('open');
            });
            // Закрываем все открытые табы
            itemsContent.forEach(content => {
                content.classList.remove('open');
            });

            // Открываем текущий таб
            if (!itemsContent[index].classList.contains('open')) {
                itemsContent[index].classList.add('open');
            } else {
                itemsContent[index].classList.remove('open');
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const servicesRow = document.querySelector(".services__row");
    const tabs = document.querySelectorAll(".services__tab");
     // Проверяем, если .services__row существует
     if (!servicesRow) return; // Если нет, выходим из функции

     // Проверяем, если есть хотя бы один таб
     if (tabs.length === 0) return; // Если табов нет, выходим из функции

    // Создаём элемент для отображения изображения
    const rowImage = document.createElement("div");
    rowImage.classList.add("services__row-image");
    servicesRow.prepend(rowImage); // Вставляем изображение в начало .services__row

    // Функция для отображения изображения
    const showImage = (tab) => {
        const tabImage = tab.querySelector(".services__tab-image"); // Находим изображение внутри таба
        if (tabImage) {
            // Создаём копию изображения
            const imageClone = tabImage.cloneNode(true);
            imageClone.classList.add("active"); // Добавляем класс для стилизации
            rowImage.innerHTML = ""; // Очищаем содержимое .services__row-image
            rowImage.appendChild(imageClone); // Добавляем копию изображения
            rowImage.style.opacity = 1; // Показываем изображение
        }
    };

    // Показываем изображение для первого таба при загрузке страницы
    if (tabs.length > 0) {
        showImage(tabs[0]);
    }

    let lastActiveTab = tabs[0]; // Сохраняем ссылку на последний активный таб

    tabs.forEach((tab) => {
        tab.addEventListener("mouseenter", function () {
            showImage(this);
            lastActiveTab = this; // Обновляем последний активный таб
        });

        tab.addEventListener("mouseleave", function () {
            showImage(lastActiveTab); // Показываем последнее активное изображение
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
        const tabTitles = document.querySelectorAll(".services__tab-title");

        tabTitles.forEach((title) => {
            title.addEventListener("click", function () {
                const tabContent = title.nextElementSibling;

                // Удаляем "open" у всех табов
                document.querySelectorAll(".services__tab-content").forEach(content => {
                    if (content !== tabContent) {
                        content.classList.remove("open");
                    }
                });

                // Переключаем "open" у кликнутого таба
                if (tabContent && tabContent.classList.contains("services__tab-content")) {
                    tabContent.classList.toggle("open");
                }
            });
        });
    });

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.accordion__header').forEach((header) => {
      header.addEventListener('click', () => {
        const item = header.closest('.accordion__item'); // Находим родительский элемент вкладки
        const content = item.querySelector('.accordion__content'); // Находим контент текущей вкладки
  
        // Закрываем все вкладки
        document.querySelectorAll('.accordion__item').forEach((otherItem) => {
          if (otherItem !== item) {
            otherItem.classList.remove('active');
            otherItem.querySelector('.accordion__content').style.maxHeight = null;
          }
        });
  
        // Открываем/закрываем текущую вкладку
        item.classList.toggle('active');
  
        if (item.classList.contains('active')) {
          content.style.maxHeight = content.scrollHeight + "px"; // Открываем контент
        } else {
          content.style.maxHeight = null; // Закрываем контент
        }
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('[data-parallax]');

    // Проверка наличия элементов с data-parallax
    if (elements.length === 0) return;

    // Получаем родительский элемент для первого элемента с data-parallax
    const parent = elements[0].closest('.choose-wise__row');

    // Если родительский элемент не найден, выходим
    if (!parent) return;

    const handleParallax = () => {
        if (window.innerWidth < 1024) {
            // Отключаем параллакс на маленьких экранах
            elements.forEach(el => el.style.transform = '');
            return;
        }

        const parentHeight = parent.offsetHeight;
        const maxTranslate = parentHeight - elements[0].offsetHeight;

        window.addEventListener('scroll', () => {
            if (window.innerWidth < 1024) return; // Проверяем при каждом скролле

            const scrollY = window.scrollY;
            const parentOffsetTop = parent.offsetTop;
            const parentBottom = parentOffsetTop + parentHeight;

            // Если родитель в зоне видимости
            if (scrollY >= parentOffsetTop && scrollY <= parentBottom) {
                const progress = (scrollY - parentOffsetTop) / parentHeight;
                const translateY = maxTranslate * progress;

                // Применяем трансформацию ко всем элементам с data-parallax
                elements.forEach(el => {
                    el.style.transform = `translateY(${translateY}px)`;
                });
            }
        });
    };

    // Запуск при загрузке
    handleParallax();

    // Перезапуск при изменении размеров окна
    window.addEventListener('resize', handleParallax);
});

  
  

document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".clients__slider", {
      loop: true, // Бесконечный слайдер
      slidesPerView: 4, // Количество видимых слайдов
      spaceBetween: 30, // Отступ между слайдами
      navigation: {
        nextEl: ".clients__button-next",
        prevEl: ".clients__button-prev",
      },
      autoplay: {
        delay: 0, // Автоматическая прокрутка
        disableOnInteraction: false,
      },
      pagination: {
        el: ".clients__pagination",
        clickable: true,
      },
      speed: 2000, // Скорость прокрутки
      breakpoints: {
        // Адаптивность
        320: {
          slidesPerView: 1,
        },
        600: {
          slidesPerView: 2,
        },
        890: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 4,
        },
      },
    });
  });



document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tabs__button');
    const cards = document.querySelectorAll('.card');

    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Убираем активный класс у всех кнопок
            tabButtons.forEach(btn => btn.classList.remove('tabs__button--active'));
            // Добавляем активный класс текущей кнопке
            this.classList.add('tabs__button--active');

            const category = this.getAttribute('data-category');

            // Показываем/скрываем карточки в зависимости от категории
            cards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const stages = document.querySelectorAll('.stage');
    const rightColumn = document.querySelector('.stages__right');

    if (!stages.length || !rightColumn) return;

    // Создаем элемент для отображения заголовка с параллаксом
    const titleElement = document.createElement('div');
    titleElement.className = 'stages__current-title';
    rightColumn.appendChild(titleElement);




    // Функция обновления активного stage
    function updateActiveStage() {
        const viewportCenter = window.scrollY + (window.innerHeight / 2);
        let activeStage = null;

        stages.forEach(stage => {
            const rect = stage.getBoundingClientRect();
            const stageTop = rect.top + window.scrollY;
            const stageBottom = stageTop + rect.height;

            if (viewportCenter >= stageTop && viewportCenter <= stageBottom) {
                activeStage = stage;
            }
        });

        stages.forEach(stage => stage.classList.remove('stage--active'));

        if (activeStage) {
            const title = activeStage.querySelector('.stage__title')?.textContent;
            if (title) {
                titleElement.textContent = title;
                activeStage.classList.add('stage--active');

                // Параллакс-эффект
                const rect = activeStage.getBoundingClientRect();
                const progress = (window.innerHeight/2 - rect.top) / rect.height;
                const parallaxOffset = progress * 30 - 15; // +/-15px диапазон
                titleElement.style.transform = `translateY(calc(-50% + ${parallaxOffset}px))`;
            }
        }
    }

    // Инициализация
    if (stages.length > 0) {
        stages[0].classList.add('stage--active');
        const firstTitle = stages[0].querySelector('.stage__title')?.textContent;
        if (firstTitle) titleElement.textContent = firstTitle;
    }

    // Оптимизированный обработчик скролла
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
        const now = Date.now();
        if (now - lastScroll > 50) { // Ограничение 20 FPS
            updateActiveStage();
            lastScroll = now;
        }
    }, {passive: true});
});




// script.js
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Gallery image lightbox functionality
    const galleryImages = document.querySelectorAll('.gallery-item img');

    galleryImages.forEach(image => {
        image.addEventListener('click', function() {
            // Implement your lightbox functionality here
            console.log('Opening lightbox for:', this.src);
        });
    });

    // Animate stats on scroll
    const animateStats = () => {
        const stats = document.querySelectorAll('.stat-number');

        stats.forEach(stat => {
            const rect = stat.getBoundingClientRect();
            const isVisible = (rect.top <= window.innerHeight && rect.bottom >= 0);

            if (isVisible && !stat.dataset.animated) {
                stat.dataset.animated = 'true';
                // Add animation class or trigger counting animation
            }
        });
    };

    window.addEventListener('scroll', animateStats);
    animateStats(); // Run once on load
});




// FAQ Accordion Functionality
const faqItems = document.querySelectorAll('.faq-item h3');
if (faqItems.length > 0) {
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const content = item.nextElementSibling;
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        });

        // Initialize - hide all answers except first
        if (item !== faqItems[0]) {
            item.nextElementSibling.style.display = 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainHeroImage');
    

    if (thumbnails.length && mainImage) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Удаляем active класс у всех миниатюр
                document.querySelectorAll('.thumbnail').forEach(t => {
                    t.classList.remove('active');
                });
                
                // Добавляем active класс текущей миниатюре
                this.classList.add('active');
                
                // Меняем основное изображение
                const newImageSrc = this.getAttribute('data-image');
                mainImage.src = newImageSrc;
                
                // Добавляем анимацию перехода
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.style.opacity = '1';
                    mainImage.style.transition = 'opacity 0.3s ease';
                }, 100);
            });
        });
    }
});

