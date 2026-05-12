document.addEventListener('DOMContentLoaded', function() {
    
    const animateElements = () => {
        const formContainer = document.querySelector('.form-container');
        const buttons = document.querySelectorAll('.auth-btn');
        const inputs = document.querySelectorAll('.form-field');
        const titles = document.querySelectorAll('h1, h2, h3');

        
        if (formContainer) {
            formContainer.style.opacity = '0';
            formContainer.style.transform = 'translateY(30px)';
        }

        buttons.forEach(btn => {
            btn.style.opacity = '0';
            btn.style.transform = 'translateY(20px)';
        });

        inputs.forEach(input => {
            input.style.opacity = '0';
            input.style.transform = 'translateY(15px)';
        });

        titles.forEach(title => {
            title.style.opacity = '0';
            title.style.transform = 'translateY(10px)';
        });

        
        requestAnimationFrame(() => {
            titles.forEach((title, index) => {
                title.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                title.style.opacity = '1';
                title.style.transform = 'translateY(0)';
            });

            setTimeout(() => {
                buttons.forEach((btn, index) => {
                    btn.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    btn.style.opacity = '1';
                    btn.style.transform = 'translateY(0)';
                });
            }, 100);

            setTimeout(() => {
                if (formContainer) {
                    formContainer.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    formContainer.style.opacity = '1';
                    formContainer.style.transform = 'translateY(0)';
                }
            }, 270);

            setTimeout(() => {
                inputs.forEach((input, index) => {
                    input.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    input.style.opacity = '1';
                    input.style.transform = 'translateY(0)';
                    input.style.transitionDelay = `${index * 80}ms`;
                });
            }, 400);
        });
    };

    
    animateElements();

    
    const searchHandler = () => {
        const searchTerm = document.querySelector('.search-input').value.toLowerCase().trim();
        document.querySelectorAll('.cart-item-card, .goods').forEach(item => {
            const titleElement = item.querySelector('.product-title, h1');
            item.style.display = titleElement?.textContent.toLowerCase().includes(searchTerm) 
                ? '' 
                : 'none';
        });
    };

    document.querySelector('.search-input')?.addEventListener('input', searchHandler);
    document.querySelector('.search-button')?.addEventListener('click', (e) => {
        e.preventDefault();
        searchHandler();
    });

    
    const showErrorModal = (message) => {
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 2vh;
            right: 2vh;
            padding: 1.5vh;
            background: #ff4444;
            color: white;
            border-radius: 0.5vh;
            z-index: 10000;
            transition: opacity 0.3s ease;
        `;
        modal.textContent = message;
        document.body.appendChild(modal);
        
        setTimeout(() => {
            modal.style.opacity = '0';
            setTimeout(() => modal.remove(), 300);
        }, 2700);
    };
});

document.addEventListener('DOMContentLoaded', function() {
    const scrollButton = document.getElementById('scrollToTop');
    
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollButton.classList.add('show');
        } else {
            scrollButton.classList.remove('show');
        }
    });

    
    scrollButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

/*
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const sunIcon = themeToggle.querySelector('.sun');
    const moonIcon = themeToggle.querySelector('.moon');
    
    
    if (!themeToggle || !sunIcon || !moonIcon) {
        console.error('Не найдены элементы кнопки темы!');
        return;
    }

    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.dataset.theme = savedTheme;
    sunIcon.style.display = savedTheme === 'light' ? 'none' : 'block';
    moonIcon.style.display = savedTheme === 'dark' ? 'block' : 'none';

    themeToggle.addEventListener('click', () => {
        const newTheme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
        document.body.dataset.theme = newTheme;
        sunIcon.style.display = newTheme === 'light' ? 'none' : 'block';
        moonIcon.style.display = newTheme === 'dark' ? 'block' : 'none';
        localStorage.setItem('theme', newTheme);
    });
});
*/


document.addEventListener('DOMContentLoaded', function() {
    const materialFilter = document.querySelector('[name="ItemSearch[material]"]');
    const sizeFilter = document.querySelector('[name="ItemSearch[size]"]');
    const goodsItems = document.querySelectorAll('.goods');

    function updateFilters() {
        const selectedMaterial = materialFilter.value;
        const selectedSize = sizeFilter.value;

        goodsItems.forEach(item => {
            const itemMaterial = item.dataset.material;
            const itemSize = item.dataset.size;

            const isMaterialMatch = !selectedMaterial || itemMaterial === selectedMaterial;
            const isSizeMatch = !selectedSize || itemSize === selectedSize;

            item.style.display = (isMaterialMatch && isSizeMatch) ? 'block' : 'none';
        });
    }

    if (materialFilter && sizeFilter) {
        materialFilter.addEventListener('change', updateFilters);
        sizeFilter.addEventListener('change', updateFilters);
    }
});


function initPriceSlider() {
    const minPrice = parseInt('<?= $searchModel->min_price ?? 0 ?>') || 0;
    const maxPrice = parseInt('<?= $searchModel->max_price ?? 100000 ?>') || 20000;
    
    $('#price-slider').slider({
        range: true,
        min: 0,
        max: 20000,
        values: [minPrice, maxPrice],
        slide: function(event, ui) {
            $('#price-min').text(ui.values[0].toLocaleString().replace(/,/g, ' '));
            $('#price-max').text(ui.values[1].toLocaleString().replace(/,/g, ' '));
        },
        stop: function(event, ui) {
            $('#min-price').val(ui.values[0]);
            $('#max-price').val(ui.values[1]);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    initPriceSlider();

    document.getElementById('apply-filters').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('filter-form').submit();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    
    const initValidation = () => {
        document.querySelectorAll('.form-field').forEach(input => {
            const validate = () => {
                const isFilled = input.value.trim().length > 0;
                const isValid = input.checkValidity?.() ?? true;
                input.classList.toggle('valid', isFilled && isValid);
            };
            
            input.addEventListener('input', validate);
            validate();
        });
    };
    
    const initPasswordToggle = (passwordId) => {
        const passwordInput = document.getElementById(passwordId);
        if (!passwordInput) return;
        
        const container = passwordInput.closest('.input-wrapper');
        if (!container) return;

        let toggle = container.querySelector('.password-toggle');
        if (!toggle) {
            toggle = document.createElement('div');
            toggle.className = 'password-toggle';
            container.appendChild(toggle);
        }

        const updateIcon = () => {
            const iconPath = passwordInput.type === 'password' 
                ? 'M12 6a9.77 9.77 0 0 1 8.82 5.5A9.77 9.77 0 0 1 12 17a9.77 9.77 0 0 1-8.82-5.5A9.77 9.77 0 0 1 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5a2.5 2.5 0 0 1 0 5 2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z'
                : 'M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46A11.804 11.804 0 0 0 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z';
            
            toggle.style.backgroundImage = `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236b4b2a'%3E%3Cpath d='${encodeURIComponent(iconPath)}'/%3E%3C/svg%3E")`;
        };

        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
            updateIcon();
            input.dispatchEvent(new Event('input')); 
        });
        
        updateIcon();
    };

    initValidation();
    initPasswordToggle('login-password');
    initPasswordToggle('register-password');
});

document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('register-password');
    const strengthBar = document.createElement('div');
    const strengthText = document.createElement('span');
    const passwordHint = document.querySelector('.password-hint');

    strengthBar.className = 'strength-bar';
    strengthText.className = 'strength-text';
    passwordHint.appendChild(strengthBar);
    passwordHint.appendChild(strengthText);

    passwordInput.addEventListener('input', function(e) {
        const password = e.target.value;
        const { strength, message } = checkPasswordStrength(password);
        updateStrengthIndicator(strength, message);
    });
    
    function checkPasswordStrength(password) {
        const minLength = 6;
        let score = 0;
        let message = '';

        if (password.length === 0) {
            return { strength: 0, message: 'Необходимо заполнить «Пароль»' };
        }

        if (password.length < minLength) {
            return { strength: 0, message: `Минимум ${minLength} символов` };
        }

        const hasLower = /[a-z]/.test(password);
        const hasUpper = /[A-Z]/.test(password);
        const hasDigit = /[0-9]/.test(password);
        const hasSpecial = /[\W_]/.test(password);

        if (hasLower) score++;
        if (hasUpper) score++;
        if (hasDigit) score++;
        if (hasSpecial) score++;

        let strength;
        if (password.length >= 12 && score === 4) {
            strength = 3; 
        } else if (score >= 3) {
            strength = 2; 
        } else if (score >= 2) {
            strength = 1; 
        } else {
            strength = 0; 
        }

        const messages = {
            0: 'Добавьте разные типы символов',
            1: 'Добавьте цифры или спецсимволы',
            2: 'Хороший пароль',
            3: 'Отличный пароль!'
        };

        return { strength, message: messages[strength] };
    }

    function updateStrengthIndicator(strength, message) {
        const colors = ['#ff4444', '#ffc107', '#4CAF50', '#2e7d32'];
        const texts = ['Слабый', 'Средний', 'Сильный', 'Очень сильный'];

        strengthBar.style.width = `${(strength + 1) * 25}%`;
        strengthBar.style.backgroundColor = colors[strength];
        strengthText.textContent = `${texts[strength]} · ${message}`;
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    let isAnimating = false;
    const animationDuration = 500; 
    function fadeOut(element, duration) {
        return new Promise(resolve => {
            let opacity = 1;
            const step = 16.66 / duration; 
            
            function animate() {
                opacity -= step;
                element.style.opacity = opacity;
                
                if (opacity > 0) {
                    requestAnimationFrame(animate);
                } else {
                    element.style.display = 'none';
                    resolve();
                }
            }
            
            requestAnimationFrame(animate);
        });
    }

    function fadeIn(element, duration) {
        return new Promise(resolve => {
            let opacity = 0;
            const step = 16.66 / duration;
            element.style.display = 'block';
            
            function animate() {
                opacity += step;
                element.style.opacity = opacity;
                
                if (opacity < 1) {
                    requestAnimationFrame(animate);
                } else {
                    resolve();
                }
            }
            
            requestAnimationFrame(animate);
        });
    }

    async function showSlide(n) {
        if (isAnimating) return;
        isAnimating = true;
        
        
        await fadeOut(slides[currentSlide], animationDuration);
        slides[currentSlide].classList.remove('active');
        
        
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        await fadeIn(slides[currentSlide], animationDuration);
        
        isAnimating = false;
    }

    
    document.querySelector('.slider-next').addEventListener('click', () => {
        showSlide(currentSlide + 1);
    });

    document.querySelector('.slider-prev').addEventListener('click', () => {
        showSlide(currentSlide - 1);
    });

   
    slides[currentSlide].style.opacity = 1;
    slides[currentSlide].style.display = 'block';
    slides[currentSlide].classList.add('active');
});

document.addEventListener('DOMContentLoaded', function() {
    // Переключение изображений
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            document.querySelector('.thumbnail.active').classList.remove('active');
            this.classList.add('active');
            mainImage.src = this.src.replace('thumb', 'pouf');
        });
    });

    // Управление табами
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Рейтинг звездами
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            stars.forEach((s, index) => {
                s.style.color = index < value ? '#ffd700' : '#ddd';
            });
        });
    });

    // Обработка формы
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Спасибо за ваш отзыв!');
        this.reset();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Обработка избранного
    const bookmarkBtn = document.querySelector('.bookmark');
    if (bookmarkBtn) {
        bookmarkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            fetch(`/site/toggle-favorite?productId=${productId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.dataset.state = data.isFavorite ? 'active' : 'inactive';
                    this.querySelector('.bookmark-text').textContent = 
                        data.isFavorite ? 'В коллекции' : 'Добавить в коллекцию';
                    this.querySelector('.bookmark-counter').textContent = data.count;
                }
            });
        });
    }
});

/*

document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    // Обработчик клика для кнопок
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Удаляем активный класс у всех кнопок и контента
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Активируем выбранную вкладку
            const targetTabId = button.getAttribute('data-tab');
            const targetContent = document.getElementById(targetTabId);
            
            button.classList.add('active');
            targetContent.classList.add('active');
        });
    });
});*/

document.addEventListener('DOMContentLoaded', function() {
    // Перехват кликов по вкладкам
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Отменяем стандартное поведение
            
            const url = this.href;
            const targetTab = this.dataset.tab;
            
            // Показываем лоадер
            document.querySelectorAll('.tab-content').forEach(content => {
                content.innerHTML = '<div class="loader">Загрузка...</div>';
            });

            // AJAX-запрос
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Маркер AJAX-запроса
                }
            })
            .then(response => response.text())
            .then(html => {
                // Парсим ответ и находим нужный контент
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById(targetTab).innerHTML;

                // Обновляем контент и URL
                document.getElementById(targetTab).innerHTML = newContent;
                history.pushState(null, null, url);

                // Обновляем активные классы
                document.querySelectorAll('.tab-btn').forEach(btn => 
                    btn.classList.remove('active')
                );
                this.classList.add('active');
            })
            .catch(error => {
                console.error('Ошибка:', error);
                window.location.href = url; // Fallback на PHP-версию
            });
        });
    });

    // Обработка истории браузера
    window.addEventListener('popstate', function() {
        window.location.reload();
    });
});