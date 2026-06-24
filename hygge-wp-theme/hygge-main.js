console.log('Hygge Main JS Loaded');

function initHygge() {
    // === ЛОГІКА БУРГЕР-МЕНЮ (ЕФЕКТ APP-ДОДАТКУ) ===
    const burgerBtn = document.getElementById('burger-btn');
    const navContainer = document.querySelector('.nav-container');

    if (burgerBtn && navContainer) {
        // 1. Автоматично створюємо кнопку "Назад" для мобільних екранів
        document.querySelectorAll('.mega-menu, .simple-menu').forEach(menu => {
            if (!menu.querySelector('.mobile-back-btn')) {
                const backBtn = document.createElement('div');
                backBtn.className = 'mobile-back-btn';
                backBtn.innerHTML = '⬅ Назад'; // Стрілочка та текст
                
                // Вставляємо кнопку на самий початок меню
                if(menu.classList.contains('mega-menu')) {
                    menu.querySelector('.mega-menu-container').prepend(backBtn);
                } else {
                    menu.prepend(backBtn);
                }

                // Закриваємо поточне підменю при кліку на "Назад"
                backBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    menu.closest('.nav-item').classList.remove('active');
                });
            }
        });

        // 2. Логіка відкриття/закриття основного бургер-меню
        burgerBtn.addEventListener('click', () => {
            navContainer.classList.toggle('active');
            burgerBtn.classList.toggle('toggle');
            
            // Якщо ми закриваємо меню хрестиком, ховаємо й усі відкриті підменю
            if (!navContainer.classList.contains('active')) {
                document.querySelectorAll('.nav-item.active').forEach(item => {
                    item.classList.remove('active');
                });
            }
        });

        // 3. Логіка кліків по посиланнях "Програми" та "Про нас"
        document.querySelectorAll('.nav-links > .nav-item > a').forEach(link => {
            link.addEventListener('click', function(e) {
                const parentLi = this.parentElement;
                
                if (parentLi.classList.contains('dropdown') || parentLi.classList.contains('simple-dropdown')) {
                    if (window.innerWidth <= 992) {
                        e.preventDefault(); 
                        // Додаємо клас active, щоб меню плавно виїхало збоку
                        parentLi.classList.add('active'); 
                    }
                    return; 
                }

                // Для звичайних посилань - закриваємо все меню і повертаємо на сторінку
                if (link.getAttribute('href') !== '#!') {
                    navContainer.classList.remove('active');
                    burgerBtn.classList.remove('toggle');
                    document.querySelectorAll('.nav-item.active').forEach(item => {
                        item.classList.remove('active');
                    });
                }
            });
        });
    }

    // === МАГІЯ СИНХРОНІЗАЦІЇ КАРТОК І ТАБІВ НА МОБІЛЬНОМУ ===
    const cardsContainer = document.querySelector('.tabs-content-area');
    const tabsContainer = document.querySelector('.tabs-sidebar');
    const tabs = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.tab-panel');

    if (cardsContainer && tabsContainer && tabs.length > 0 && cards.length > 0) {
        // 1. СВАЙП КАРТОК -> ОНОВЛЮЄ ТАБИ
        cardsContainer.addEventListener('scroll', () => {
            if (window.innerWidth > 992) return; 

            let scrollLeft = cardsContainer.scrollLeft;
            let cardWidth = cards[0].offsetWidth + 15; 
            let activeIndex = Math.round(scrollLeft / cardWidth);

            tabs.forEach((tab, index) => {
                if (index === activeIndex) {
                    tab.classList.add('active');
                    tab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                } else {
                    tab.classList.remove('active');
                }
            });
        });

        // 2. КЛІК ПО ТАБУ
        tabs.forEach((tab, index) => {
            tab.addEventListener('click', (e) => {
                e.preventDefault(); 

                if (window.innerWidth > 992) {
                    // ДЕСКТОП: Перемикаємо класи через data-tab та id
                    tabs.forEach(t => t.classList.remove('active'));
                    cards.forEach(c => c.classList.remove('active'));
                    
                    tab.classList.add('active');
                    
                    const targetId = tab.getAttribute('data-tab');
                    if (targetId) {
                        const targetPanel = document.getElementById(targetId);
                        if (targetPanel) {
                            targetPanel.classList.add('active');
                        }
                    }
                } else {
                    // МОБІЛЬНИЙ: Вираховуємо ширину кроку та плавно прокручуємо карусель
                    let cardWidth = cards[0].offsetWidth + 15; 
                    cardsContainer.scrollTo({
                        left: index * cardWidth,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // === ЛОГИКА ФИЛЬТРОВ ДЛЯ СТРАНИЦ (Кейсы, Блог) ===
    const filterBtns = document.querySelectorAll('.filter-btn');
    const filterCards = document.querySelectorAll('.item-card');

    if (filterBtns.length > 0 && filterCards.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter');

                filterCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (filterValue === 'all' || filterValue === cardCategory) {
                        card.style.display = 'flex';
                        card.style.animation = 'fadeIn 0.5s ease forwards';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // === AJAX-ВІДПРАВКА ФОРМИ В SAP B1 ===
    const sapForms = document.querySelectorAll('.cta-form');

    if (sapForms.length > 0 && typeof hyggeAjax !== 'undefined') {
        sapForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerText;
                submitBtn.innerText = 'Відправлення...';
                submitBtn.disabled = true;

                const formData = new FormData(form);
                formData.append('action', 'submit_sap_form');
                formData.append('nonce', hyggeAjax.nonce);

                const existingMsg = form.querySelector('.sap-form-message');
                if (existingMsg) existingMsg.remove();

                fetch(hyggeAjax.ajaxurl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'sap-form-message';
                    msgDiv.style.marginTop = '15px';
                    msgDiv.style.padding = '10px';
                    msgDiv.style.borderRadius = '5px';
                    msgDiv.style.textAlign = 'center';

                    if (data.success) {
                        msgDiv.style.backgroundColor = 'rgba(0, 200, 83, 0.1)';
                        msgDiv.style.color = '#00C853';
                        msgDiv.innerText = data.data.message;
                        form.reset();
                    } else {
                        msgDiv.style.backgroundColor = 'rgba(213, 0, 249, 0.1)';
                        msgDiv.style.color = 'var(--accent-purple)';
                        msgDiv.innerText = data.data.message || 'Помилка відправки.';
                    }
                    form.appendChild(msgDiv);
                })
                .catch(error => {
                    console.error('Помилка:', error);
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'sap-form-message';
                    msgDiv.style.marginTop = '15px';
                    msgDiv.style.padding = '10px';
                    msgDiv.style.borderRadius = '5px';
                    msgDiv.style.textAlign = 'center';
                    msgDiv.style.backgroundColor = 'rgba(213, 0, 249, 0.1)';
                    msgDiv.style.color = 'var(--accent-purple)';
                    msgDiv.innerText = 'Помилка мережі. Спробуйте пізніше.';
                    form.appendChild(msgDiv);
                })
                .finally(() => {
                    submitBtn.innerText = originalBtnText;
                    submitBtn.disabled = false;
                });
            });
        });
    }
}

// Запускаємо все безпечно
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHygge);
} else {
    initHygge();
}
