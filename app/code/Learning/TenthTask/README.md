Tenth Task:

1. Создать таблицу mdg_entity с полями entity_id (int), title (text), created_at, updated_at (date with update on save), product_id (int and foreign key on catalog_product_entity.entity_id), status (smalint: 0,1,2), description
2. Создать в таблице внешние ключи индексы и фултекст индекс на поля description и title
3. На странице которая открывается по пункту меню MDG - Manage Entities  - создать UI GRID  который является представлением этой таблицы  (смотреть как пример грид ордеров или любой другой грид в админке)
4. У грида должны быть кроме стандартных колонок данных и экшнов - фильтра и сортировка по колонкам
5. Так же должен быть поле фултекст поиска и масс экшны

Масс экшны будут иметь только 1 пункт - изменение поля  status 0-1-2
