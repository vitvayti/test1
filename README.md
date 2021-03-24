# Тестовое задание

Федеральная ювелирная сеть «585/Золотой»

https://zolotoy.ru

Дано:
- Текст из *.csv файла

Необходимо:
1. Распарсить текст, подготовить данные к работе (элемент = тип Объект)
2. Отсортировать данные по дате затем КБК и вывести в таблице, таким образом, что если существует несколько записей на одну дату с одним КБК, то в поле %% считать среднее, а в скобках вывести кол-во елементов.

Пример таблицы:

| ДАТА | КБК | Адрес | %% | 
| ------------- | ------------- |------------- | ------------- |
| 11.01.2013  | 1-01-001 | Спб, Восстания, 1  | 84% (2) |
