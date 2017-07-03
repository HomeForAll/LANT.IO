# Общие положения
Весь PHP код должен быть разбит на некоторые составляющие.  
  
**Модель:**  
Доступ к модели имеет как вид, так и контроллер.    
Публичными должны быть только get | set методы доступа к своим данным, а так же методы предназначенные для модификации этих данных.

Допускается  | Не допускается
------------- | -------------
Получение данных  | Прямой доступ к переменным
Хранение данных  | Написание логики работы с данными (если это возможно)
Модификация данных  | -
Возврат данных  | -

**Контроллер:**  
Вся логическая работа с данными и обработка запросов пользователя происходит в контроллере,
данные модели могут изменяться лишь посредством ее публичных методов.

Допускается  | Не допускается
------------- | -------------
Обеспечение логики работы с данными | Получение данных
Обработка запросов пользователя | Передача данных
Модификация данных посредством публичных методов модели | 

**Вид:**    
В виде **категорически** запрещается модифицировать данные модели, он предназначен лишь, для вывода обработанных моделью данных с помощью ее публичных методов, которые для этого предназначены.


# Стандарты форматирования кода
Для PHP используем стандарты принятые группой PHP-FIG (за исключением пространств имен):      

[PSR-1 – Базовый стандарт оформления кода (перевод)](https://svyatoslav.biz/misc/psr_translation/#_PSR-1)  
[PSR-2 – Рекомендации по оформлению кода (перевод)](https://svyatoslav.biz/misc/psr_translation/#_PSR-2)   
[Описание всех стандартов группы PHP-FIG (первоисточник, на английском)](http://www.php-fig.org/psr)

## Краткая помощь по стандартам
#### Общая информация

Название  | Описание
------------- | -------------
Допустимые теги  | \<?php ?\>, \<?= ?\> 
Кодировка символов  | UTF-8 без BOM-байта
Отступы  | четыре пробела

#### Форматирование кода

Элемент  | Пример
------------- | -------------
Классы  | SiteController
Константы  | VERSION, DATE_APPROVED
Ключ ассоциативного массива | 'under_score'
Свойства  |  $camelCase
Методы  |  renameElement()
Ключевые слова  |  true, false и null
   
 
Пример охватывающий большинство правил:      
```
<?php
    
    /**
     * Описание интерфейся
     */
    interface FooInterface
    {
    }
    
    /**
     * Описание класса
     */
    class Foo extends Bar implements FooInterface
    {
        const VERSION = '2.0';
    
        private $camelCase;
            
        abstract public function sampleFunction();
        
        public function sampleFunction($a, $b = null)
        {
            if ($a === $b) {
                bar();
            } elseif ($a > $b) {
                $foo->bar($arg1);
            } else {
                BazClass::bar($arg2, $arg3);
            }
        }
     
        final public static function getVersion()
        {
            return self::VERSION;
        }
        
        public function runSwitch()
        {
            switch ($expr) {
                case 0:
                    echo 'Первый кейс';
                    break;
                case 1:
                    echo 'Второй кейс';
                case 2:
                case 3:
                case 4:
                    echo 'Четвертый кейс';
                default:
                    echo 'Default case';
                    break;
            }
        }
        
        public function runWhile()
        {
            while ($expr) {
                // тело конструкции
            }
        }
        
        public function runDoWhile()
        {
            do {
                // тело конструкции
            } while ($expr);
        }
        
        public function runFor()
        {
            for ($i = 0; $i < 10; $i++) {
                // тело for
            }
        }
        
        public function runForeach()
        {
            foreach ($iterable as $key => $value) {
                // тело foreach
            }
        }
        
        public function runTryCatch()
        {
            try {
                // тело try
            } catch (FirstExceptionType $e) {
                // тело catch
            } catch (OtherExceptionType $e) {
                // тело catch
            }
        }
    }
```