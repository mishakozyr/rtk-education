-- Таблица employee_self_join:

create table employee_self_join(
	employee_id int primary key,
	first_name varchar (255) not null,
	last_name varchar (255) not null,
	manager_id int,
	foreign key (manager_id)
	references employee_self_join (employee_id)
	on delete cascade
);
insert into employee_self_join (
	employee_id,
	first_name,
	last_name,
	manager_id
)
values 
	(1,'Windy', 'Hays', null),
	(2, 'Ava', 'Christensen', 1),
	(3, 'Hassan', 'Conner', 1),
	(4, 'Anna', 'Reeves', 2),
	(5, 'Sau', 'Norman', 2),
	(6, 'Kelsie', 'Hays', 3),
	(7, 'Tory', 'Goff', 3),
	(8, 'Salley', 'Lester', 3);

-- 1. Найти заказчиков и обслуживающих их заказы сотрудников таких, 
-- что и заказчики и сотрудники из города London, а доставка идёт компанией Speedy Express. 
-- Вывести компанию заказчика и ФИО сотрудника.

select customers.company_name customer_company, employees.first_name || ' ' || employees.last_name employer
from orders
inner join customers using(customer_id)
inner join employees using(employee_id)
inner join shippers on orders.ship_via = shippers.shipper_id
where customers.city = 'London' and employees.city = 'London' and shippers.company_name = 'Speedy Express';

-- 2. Найти активные (см. поле discontinued) продукты из категории Beverages и Seafood, 
-- которых в продаже менее 20 единиц. Вывести наименование продуктов, кол-во единиц в продаже, 
-- имя контакта поставщика и его телефонный номер.

select product_name, units_in_stock, contact_name, suppliers.phone
from products
inner join suppliers using(supplier_id)
inner join categories using(category_id)
where discontinued = 0 and category_name in ('Beverages', 'Seafood') and units_in_stock < 20;

-- 3. Найти заказчиков, не сделавших ни одного заказа. Вывести имя заказчика и order_id.

select contact_name, orders.order_id
from customers
inner join orders using(customer_id)
where orders.customer_id is null;

-- 4. Переписать предыдущий запрос, использовав симметричный вид джойна 
-- (подсказка: речь о LEFT и RIGHT).

select contact_name, orders.order_id
from customers
left join orders using(customer_id)
where orders.customer_id is null;

select customers.contact_name, order_id
from orders
right join customers using(customer_id)
where orders.customer_id is null;

-- 5. Выведите из таблицы employee_self_join всех сотрудников, 
-- которые не являются менеджерами и отсортируйте по возрастанию имени сотрудника.

select e.first_name || ' ' || e.last_name as employer
from employee_self_join e
inner join employee_self_join m on m.employee_id = e.manager_id
where m.manager_id is not NULL
order by employer asc;

-- 6. Найти из таблицы employee_self_join всех топ менеджеров

select m.first_name || ' ' || m.last_name as manager, COUNT(e.manager_id) as top_manager
from employee_self_join m
inner join employee_self_join e on m.employee_id = e.manager_id
GROUP by manager
order by top_manager desc;

-- 7. Найти из таблицы employee_self_join всех сотрудников, у которых нет подчинённых.

select first_name || ' ' || last_name employee
from employee_self_join 
where manager_id is null;

-- 8. В клиентской базе найти пары регионов, у которых совпадает страна. 
-- Важно, чтобы они имели названия. После получения результата. 
-- Оставьте в списке пункты с шестого по пятнадцатый включительно. Строки в таблице повторятся не должны.

select distinct(c1.region, c2.region), c1.country
from customers c1
join customers c2 on c1.country = c2.country
where c1.region is not null and c2.region is not null
offset 5
limit 10;

-- Дополнительно! Регионы должны состоять из двух символов.

select distinct(c1.region, c2.region), c1.country
from customers c1
join customers c2 on c1.country = c2.country
where c1.region like '__' and c2.region like '__' and c1.region is not null and c2.region is not null
offset 5
limit 10;

