Fifth Task <br/>
Создать плагины на интерфейс продукта
1 Бефор плагин на setName - изменить аргумент имя добавить к имени ' CUSTOMIZED';
2 Афтер плагин на getPrice  - увеличить цену в 2 раза
3 Эраунд плагин на save продукта - в плагине до сейва
• до сейва если продукт новосозданный - записать в кастомный лог файл - SKU: xxx is NEW
• После сейва проверить если у продукта цена меньще 100 - записать в кастомный лог файл информацию  SKU: xxx price lower then 100!

Создать оверрайд на блок  котором выводится продакт вью и переписать логику проттектед метода


Напиши несколько плагинов и задай им разные порядки выполненния



* [1)Создадим  di.xml где пропишем зависимости](./etc/di.xml)
* [2) 1-BeforeSetNamePlugin.php](./Plugin/BeforeSetNamePlugin.php)
* [2) 2-AfterGetPricePlugin.php](./Plugin/AfterGetPricePlugin.php)
* [2) 3-AroundProductSavePlugin.php](./Plugin/AroundProductSavePlugin.php)

