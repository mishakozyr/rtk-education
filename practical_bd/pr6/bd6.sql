-- 1. Рассчитайте общую стоимость заказов с учетом скидки и сгруппируйте по order_id. 
-- Округлите значение суммы до ближайшего целого. Отсортируйте выборку по номеру заказа.

select order_id, round(sum(cast((unit_price * quantity) * (1 - discount) as numeric)), 0) as total_cost
from order_details
group by order_id
order by order_id;

-- 2. Необходимо для сотрудников выгрузить информацию для отчёта, как показано на скриншоте ниже. 
-- Соедините в единое поле – фамилию и имя, рассчитайте для поля «стаж» интервал, 
-- сколько сотрудник уже работает на компанию. Не забывайте использовать псевдонимы для колонок.

create view employee_report as
select concat(last_name, ' ', first_name) as fio, 
title, age(current_date, hire_date) as experience
from employees;

select *
from employee_report

-- 3. Выведите имя и фамилию сотрудника, у которого самое большое количество символов в поле ФИО.

select concat(first_name, ' ', last_name) as full_name
from employees
order by length(first_name || last_name) desc
limit 1;

-- 4. Сделайте выборку с одной колонкой customer_id. Переведите символы строки в нижний регистр.

select lower(customer_id) as customer_id_lower
from customers;

-- 5. Рассчитайте возраст сотрудников компании.

select first_name, extract(year from age(now(), birth_date)) as age 
from employees;

-- 6. Руководитель компании хочет выдать премии сотрудникам. Вам необходимо составить следующий 
-- список сотрудников - если должность “Sales Representative” тогда размер премии 4000, 
-- для остальных 2000 + воля случая рандома, который будет дополнительным процентом от 2000.

select first_name, title,
case
	when title = 'Sales Representative' then 4000
    else round(cast(2000 + ((RANDOM() * 11) / 100.0) * 2000 as numeric), 2)
end as bonus
from employees

-- 7. Узнать, кто из сотрудников старше всех в организации.

select concat(first_name, ' ', last_name) as full_name, birth_date
from employees
where birth_date = (select max(birth_date) from employees);

-- 8. Посчитать количество заказов в каждый год. Вывести данные согласно скриншоту.

SELECT date_part('year', order_date) AS year, COUNT(*) AS count
FROM orders
GROUP BY year;

