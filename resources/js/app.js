import './bootstrap';
import '../css/app.css';
/*
Компоненты, которые нужны:

Страницы:
    - Главная:
    -- Истории
    -- Боковой скрол: секции
    -- Боковой скрол: заведения
    -- Боковой скрол: категории товара
    -- Случайные товары
    -- Случайные недавние заказы
    -- Форма обратной связи
    -- Добавить на телефон
    - Города:
    -- Заведения по городам
    - Компании (заведения)
    - Товары
    - Категории товара
    - Продукты в категории
    - Товары в секции
    - Статус заказа
    - История заказов
    - Продукты из магазина
    - Корзина
    - Страница оформление заказа
    - Оплата
    - Заказ по телефону (когда оператор собирает заказ,
        он говорит клиенту код заказа или отправляет sms-кой ссылку на оплату заказа,
         по которому клиент может оплатить заказ):
    - Избранное (Мне понравилось)
    - Обратная связь \ О нас \ Наша команда
    - Правила использования сервиса
    - Сотрудничество \ Подключение \ Работа (Вакансии)
    - АПИ \ Для программистов
    - Страница входа \ Регистрации
    - Профиль пользователя
    - История оплаты


    - Конструкторы:
    -- Пицца
    -- Кофе
    -- Суши
    -- Вафли
 */
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
