# Чеклист внедрения оптимизаций

## 1) JS и CSS
- [x] Оставить в `resources/views/layouts/app.blade.php` только базовые скрипты.
  - Убраны: `landing/jquery.inputmask.min.js`, `landing/slick.min.js`, `landing/jquery.fancybox.min.js`, `landing/main.js`
  - Добавлен `defer` на все скрипты после jQuery
- [x] Перенести `slick/fancybox/counterup/waypoints/YTPlayer` в постраничные `@push('scripts')`.
  - inputmask → @push на home, services/show, services/category, landings/show, about
  - slick → @push на services/show, services/category (условие: reviews)
  - fancybox → @push на services/show, services/category, landings/show (условие: gallery)
- [x] Добавить `defer` для скриптов, не влияющих на первый экран.
  - jQuery — синхронный (основа), все остальные — `defer`
  - Скрипты в @push — `defer` для внешних, `DOMContentLoaded` вместо `$(document).ready()`
- [x] Проверить, что нет inline-скриптов, зависящих от `$`, до подключения jQuery.
  - Все inline-скрипты обёрнуты в `DOMContentLoaded`, jQuery загружается первым
- [x] Подготовить Vite-сборку (prod) с минификацией.
  - `function.js` собран через Vite: 16.8 KB → 6.8 KB (gzip: 2.5 KB, -59.5%)
  - `@vite(['resources/js/function.js'])` в обоих layout
  - `custom.css` остался в `public/css/` — ссылки `url(../images/...)` несовместимы с Vite без реорганизации ассетов

## 2) Изображения
- [x] Найти самые тяжелые изображения первого экрана.
  - `hero-image-prime.jpg`, `hero-image-about.jpg` — hero-изображения
- [ ] Сделать WebP/AVIF версии.
  - Требует серверной конвертации или srcset с .webp вариантами
- [ ] Добавить `srcset` и `sizes` для карточек и контентных изображений.
  - Требует подготовки нескольких разрешений каждого изображения
- [x] Добавить `width`/`height` на `<img>` чтобы снизить CLS.
  - Добавлены на hero-изображения, логотип, иконки, карточки
- [x] Для ниже первого экрана включить `loading="lazy"` и `decoding="async"`.
  - Добавлены на все изображения ниже fold (карточки, галереи, examples, footer)

## 3) Шрифты
- [x] Оценить переход с внешней загрузки Google Fonts на self-host.
  - Выполнено: создан `public/css/inter-tight.css`, шрифты в `public/fonts/inter-tight/`
  - Только нужные веса: 400, 500, 600, 700, 900 (без italic)
  - Только нужные subsets: cyrillic-ext, cyrillic, latin
- [x] Проверить `font-display: swap`.
  - Все @font-face декларации содержат `font-display: swap`
- [x] Уменьшить количество подключаемых начертаний.
  - Было: 100..900 + italic (20+ файлов). Стало: 5 весов × 3 subset = 15 файлов (~434KB, но подгружаются только нужные subset'ы)

## 4) Кеширование и сервер
- [x] Проверить/обновить cache headers в `public/.htaccess`.
  - Добавлен Brotli (mod_brotli) и Gzip (mod_deflate) для HTML/CSS/JS/JSON/SVG/fonts
  - Увеличен TTL статики до 1 года (31536000 сек)
  - Добавлен `immutable` для Cache-Control
- [x] После включения hash-файлов выставить долгий TTL для статики (до 1 года).
  - max-age=31536000, immutable для .css/.js/.woff2/.jpg/.png/.webp/.svg/.ico
- [ ] Проверить OPcache в прод-конфиге PHP.
  - Требует доступа к прод-серверу
- [x] Включить Brotli или Gzip.
  - Добавлены оба: mod_brotli (приоритетнее) и mod_deflate (fallback)
- [ ] Проверить кеш backend-выборок для публичных страниц.
  - Требует анализа контроллеров и запросов БД

## 5) Валидация
- [ ] Прогнать PSI mobile для главной и ключевых страниц.
- [ ] Сравнить до/после: LCP, INP, CLS, TTFB, общий Performance score.
- [ ] Проверить отсутствие JS-ошибок в консоли.
- [ ] Проверить корректную работу форм, модалок, слайдеров после оптимизаций.

## Дополнительные выполненные оптимизации
- [x] Некритичные CSS (slicknav, swiper, magnific-popup, mousecursor, slick, landing) → `media="print" onload="this.media='all'"` (async CSS load)
- [x] `fetchpriority="high"` на hero-изображения
- [x] Security headers: X-Content-Type-Options, X-Frame-Options, Referrer-Policy, Permissions-Policy
- [x] Убраны дублирующиеся загрузки inputmask/slick/fancybox (были и в layout, и в @push)
