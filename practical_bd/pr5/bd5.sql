-- 1. Создать представление, которое выводит следующие колонки:
-- order_date, required_date, shipped_date, ship_postal_code, company_name, 
-- contact_name, phone, last_name, first_name, title из таблиц orders, customers и employees.

create view orders_customers_employees as
select order_date, required_date, shipped_date, ship_postal_code, company_name, 
contact_name, phone, last_name, first_name, title
from orders
join customers using(customer_id)
join employees using(employee_id);


-- Сделать SELECT к созданному представлению, выведя все записи, где order_date больше 1 января 1997 года.

select *
from orders_customers_employees
where order_date > '1997-01-01';

-- 2. Создать представление, которое выводит следующие колонки:
-- order_date, required_date, shipped_date, ship_postal_code, ship_country, 
-- company_name, contact_name, phone, last_name, first_name, title из таблиц orders, customers, employees.

create view orders_customers_employees_two as
select order_date, required_date, shipped_date, ship_postal_code, ship_country, 
company_name, contact_name, phone, last_name, first_name, title
from orders
join customers using(customer_id)
join employees using(employee_id);


-- Попробовать добавить к представлению (после его создания) колонки ship_country, postal_code и reports_to. 
-- Описать результат и почему.

create or replace view orders_customers_employees_two as
select order_date, required_date, shipped_date, ship_postal_code, ship_country, 
company_name, contact_name, phone, last_name, first_name, title,
ship_country, postal_code, reports_to
from orders
join customers using(customer_id)
join employees using(employee_id);

-- выводит ошибку, тк в двух таблицах присутствует одиннаковые название стобцов, 
-- и СУБД не может однозначно определить, на какой именно столбец ссылается запрос.

-- Переименовать представление и создать новое уже с дополнительными колонками.

alter view orders_customers_employees_two RENAME TO orders_customers_employees_two_old

create view orders_customers_employees_three as
select order_date, required_date, shipped_date, ship_postal_code, ship_country, 
company_name, contact_name, phone, last_name, first_name, title,
employees.postal_code, reports_to
from orders
join customers using(customer_id)
join employees using(employee_id);

-- Сделать к нему запрос, выбрав все записи, отсортировав их по ship_country

select *
from orders_customers_employees_three
order by ship_country;

-- Удалить переименованное представление.

drop view if exists orders_customers_employees_two_old;

-- 3. Создать представление продуктов, которые сняты с производства (discontinued = 1) содержащее все колонки. 
-- Представление должно быть защищено от вставки записей, в которых discontinued = 0.

create view products_discontinued as
select *
from products
where discontinued = 1
with check option;

-- Попробовать сделать вставку записи с полем discontinued = 0 - убедиться, что такая вставка не удается.

insert into products_discontinued
values (100, 'abc', 1, 1, 'abc', 1, 1, 1, 1, 0);

-- 4. Создать представление, которое будет содержать первые 10 заказов отсортированные по возрастанию 
-- даты формирования заказа, необходимо показывать только номер заказа и название службы доставки.

create view zakaz as
select order_id, ship_name
from orders
order by order_date asc
limit 10

-- 5. Составьте собственный запрос к базе, обязательное условие – использование любого join 
-- и конструкции where. Опишите какие данные вы получаете с помощью этого запроса. 
-- Сохраните его как представление с защитой от вставки информации, нарушающей ваше условие. 

create view orders_in_countries_starting_with_u as
select order_id, order_date, ship_country, company_name, contact_name, phone
from orders
inner join customers using(customer_id)
where ship_country like 'U%'
-- with check option;

-- Этот запрос создает представление orders_in_countries_starting_with_u, 
-- которое содержит следующие колонки: order_id, order_date, ship_country, 
-- company_name, contact_name, phone. 
-- Все записи, в которых ship_country не начинается с буквы "U", 
-- будут исключены из этого представления благодаря оператору LIKE в конструкции WHERE.
-- WITH CHECK OPTION обеспечивает защиту представления от вставки записей, 
-- которые не соответствуют условию ship_country LIKE 'U%'.

-- Мы можем использовать это представление, чтобы получить список всех заказов, 
-- которые были сделаны в странах, начинающихся с буквы "U", 
-- и содержат информацию о компании-заказчике, включая ее контактное лицо и номер телефона.




