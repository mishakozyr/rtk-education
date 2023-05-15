-- 1.1. Выбрать все данные из таблицы customers.

select * 
from customers;

-- 1.2. Выведите список названий товаров и их цену.

select products_name, unit_price 
from products;

-- 1.3. Выберите из таблицы region только колонку с названием.

select region_description 
from region;

-- 1.4. Выведите список названий компаний поставщиков.

select company_name 
from shippers;

-- 1.5. Выбрать записи из таблицы customers, но только имя контакта и город.

select contact_name, city 
from customers;

-- 1.6. Выбрать записи из таблицы заказы, но взять две колонки: 
-- идентификатор заказа и колонку, значение в которой мы рассчитываем, 
-- как разницу между датой отгрузки и датой оформления заказа.

select order_id, (required_date - shipped_date) as difference 
from orders;

-- 1.7. Посчитать кол-во заказов в базе.

select count(order_id) 
from orders; 

-- 1.8. Выбрать все уникальные города, в которых живут заказчики.

select distinct city 
from customers;

-- 1.9. Выбрать все уникальные сочетания городов и стран заказчиков.

select distinct city, country 
from customers;

-- 1.10. Посчитайте количество уникальных стран заказчиков.

select count(distinct country) 
from customers; 

-- 2.1. Выбрать все заказы из стран France, Austria, Spain

select * 
from orders
where ship_country in ('France', 'Austria', 'Spain');

-- 2.2. Выбрать все заказы, отсортировать по required_date (по убыванию) и 
-- отсортировать по дате отгрузке (по возрастанию)

select *
from orders
order by required_date desc, shipped_date asc; 

-- 2.3. Выбрать минимальное кол-во единиц товара среди тех продуктов, которых в продаже более 30 единиц.

select min(units_in_stock) 
from products
where units_in_stock > 30;

-- 2.4. Выбрать максимальное кол-во единиц товара среди тех продуктов, которых в продаже более 30 единиц.

select max(units_in_stock) 
from products
where units_in_stock > 30;

-- 2.5. Найти среднее значение дней, уходящих на доставку с даты формирования заказа в USA.

select avg(shipped_date - order_date) 
from orders
where ship_country = 'USA';

-- 2.6. Найти сумму, на которую имеется товаров (кол-во * цену) причём таких, 
-- которые планируется продавать и в будущем (см. на поле discontinued).

select sum(units_in_stock * unit_price) as total_sum
from products
where discontinued = 0;

-- 3.1. Выбрать все записи заказов, в которых наименование страны отгрузки начинается с 'U'.

select *
from orders
where ship_country like 'U%';

-- 3.2. Выбрать записи заказов (включить колонки идентификатора заказа, 
-- идентификатора заказчика, веса и страны отгрузки), 
-- которые должны быть отгружены в страны имя которых начинается с 'N', 
-- отсортировать по весу (по убыванию) и вывести только первые 10 записей.

select order_id, customer_id, freight, ship_country
from orders 
where ship_country like 'N%'
order by freight desc 
limit 10;

-- 3.3. Выбрать записи работников (включить колонки имени, фамилии, телефона, региона) 
-- в которых регион неизвестен.

select first_name, last_name, home_phone, region
from employees
where region is null;

-- 3.4. Подсчитать кол-во заказчиков регион которых известен.

select count(customer_id)
from customers
where region is null;

-- 3.5. Подсчитать кол-во поставщиков в каждой из стран и отсортировать результаты группировки по убыванию кол-ва.

select country, count(*)
from suppliers
group by country
order by count(*) desc;

-- 3.6. Подсчитать суммарный вес заказов (в которых известен регион) по странам, 
-- затем отфильтровать по суммарному весу (вывести только те записи где суммарный вес больше 2750) и 
-- отсортировать по убыванию суммарного веса.

select ship_country, sum(freight)
from orders 
where ship_region is not null
group by ship_country
having sum(freight) > 2750
order by sum(freight) desc;

-- 3.7. Выбрать все уникальные страны заказчиков и поставщиков и отсортировать страны по возрастанию.

select distinct country from customers
union
select distinct country from employees 
order by country asc;

-- 3.8. Выбрать такие страны, в которых зарегистрированы одновременно и заказчики, и поставщики, и работники.

select country from customers
intersect 
select country from suppliers
intersect 
select country from employees;

-- 3.9. Выбрать такие страны, в которых зарегистрированы одновременно заказчики и поставщики, 
-- но при этом в них не зарегистрированы работники

select country from customers
intersect 
select country from suppliers
except 
select country from employees;



