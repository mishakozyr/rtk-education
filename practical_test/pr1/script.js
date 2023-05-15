

// функция принимает количество юнитов возвращает массив из функций с информацией по каждому юниту
function formingArmy(quantity) {
	let army_arr = [];

    // функция рандомных чисел
    function randomNum(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
	
	for (let i = 1; i <= quantity; i++) {
        let soldier = {
            n: i,
            hp: randomNum(1, 100),
            armor: randomNum(1, 100),
            attack: randomNum(1, 100)
        }
		army_arr.push(function() { return soldier; });	
	}
    
    return army_arr;
}

let res = formingArmy(5);
// console.log(res);

for (let i = 0; i <= (res.length-1); i++) {
    let unit = res[i]();
    let str_unit = `    порядковый номер юнита: ${unit.n}
    уровень «жизненной энергии» юнита: ${unit.hp}
    уровень защиты юнита: ${unit.armor} 
    уровень атакующией силы юнита: ${unit.attack}`  
    console.log(str_unit);
}











let arr_tasks = []; // массив задач

// функция возвращает массив с функциями планировщика задач 
function toDoList() {
    let arr_func = []; // массив функций с планировщиком задач
    let i = 1; // счетчик задач

    // функция добавления задачи
    arr_func[0] = function(task_text) {
        let task = {
            n: i++, // номер задачи
            text: task_text, // текст задачи
            status : "активная" // статус задачи активная, завершенная, удаленная
        };
        arr_tasks.push(task);
        return arr_tasks[i-2];
    };

    // функция отметки задачи выполненной
    arr_func[1] = function(num_task) {
        let task = arr_tasks[num_task-1];
        task.status = "завершенная";
        return task;
    }

    // функция отметки о удалении задачи
    arr_func[2] = function(num_task) {
        let task = arr_tasks[num_task-1];
        if (task.status == "активная") {
            alert("нельзя удалить незавершенную задачу!!!");
        } else if (task.status == "завершенная") {
            task.status = "удаленная";
        }
        return task;
    }

    // функция возвращения списка не выполненных (активных) задач;
    arr_func[3] = function() {
        let task = arr_tasks.filter(function(task) {
            return task.status == "активная";
        })
        return task;
    }

    // функция возвращения списка завершенных задач;
    arr_func[4] = function() {
        let task = arr_tasks.filter(function(task) {
            return task.status == "завершенная";
        })
        return task;
    }

    // функция возвращения списка удаленных задач;
    arr_func[5] = function() {
        let task = arr_tasks.filter(function(task) {
            return task.status == "удаленная";
        })
        return task;
    }

    // функция возвращения списка всех задач;
    arr_func[6] = function() {
        return arr_tasks;
    }

    return arr_func; // возвращает массив функций
}

let one = toDoList();
// console.log(one);
// console.log(one[0]("сделать 1 практическую"));
// console.log(one[0]("сделать 2 практическую"));

// console.log(one[1](1));

// console.log(one[2](1));
// console.log(one[2](2));

// console.log(one[3]());

// console.log(one[3]().comp_task);

// console.log(one[5]());

// console.log(one[6]());





function isInArray(n, arr) {
    if (arr.some(e => e.n == n)) {
        return true 
    } else {
        return false
    }
}
// console.log(isInArray(1, one[3]()));

let c = true;

while (c) {

    let start = prompt("1 - Добавить новую задачу\n2 - Отметить задачу выполненной\n3 - Удалить задачу, удалить можно только завершенную задачу\n"+
    "4 - Возвращение списка не выполненных (активных) задач\n5 - Возвращение списка завершенных задач\n6 - Возвращение списка удаленных задач\n"+
    "7 - Возвращение списка всех задач\n8 - Выйти");
    
    switch (start) {

        case "1":
            let text_task = prompt("Введите текст для новой задачи:");
            one[0](text_task);
            break;

        case "2":
            let comp_task = prompt("Введите номер задачи, которую нужно отметить выполненной: "); 
            let comp_text_alert = "";

            if (isInArray(comp_task, one[3]())) {
                one[1](comp_task);
                comp_text_alert =`Задача ${comp_task} отмечена завершенной!`;

            } else if (isInArray(comp_task, one[4]())) {
                comp_text_alert = `Задача ${comp_task} выполнена!`;

            } else if (isInArray(comp_task, one[5]())) {
                comp_text_alert = `Задача ${comp_task} удалена!`;

            } else if (comp_task == null) {
                comp_text_alert = "";
            } else {
                comp_text_alert = `Задачи ${comp_task} не сущестует!`;

            }

            if (comp_text_alert.length) {
                alert(comp_text_alert);
            }
            break;

        case "3":
            let del_task = prompt("Введите номер задачи, которую хотите удалить: "); 
            let del_task_text = "";

            if (isInArray(del_task, one[4]())) {
                one[2](del_task);
                del_task_text = `Задача ${del_task} успешно удалена!`;

            } else if (isInArray(del_task, one[3]())) {
                del_task_text = `Задача ${del_task} еще не выполнена!\nУдалить можно только выполненные задачи!`;

            } else if (isInArray(del_task, one[5]())) {
                del_task_text = `Задача ${del_task} удалена!`;
                
            }  else if (del_task == null) {
                del_task_text = "";
            } else {
                del_task_text = `Задачи ${del_task} не сущестует!`;

            }

            if (del_task_text.length) {
                alert(del_task_text);
            }
            break;

        case "4":
            alert(one[3]().length ? one[3]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n") : "Список завершенных задач пуст.");
            break;

        case "5":
            alert(one[4]().length ? one[4]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n") : "Список завершенных задач пуст.");
            break;

        case "6":
            alert(one[5]().length ? one[5]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n") : "Список удаленных задач пуст.");
            break;

        case "7":
            alert(one[6]().length ? one[6]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n") : "Список всех задач пуст.");
            break;

        case "8":
            exit = confirm("Вы действительно хотите выйти?");
            if (exit) c = false;
            break;

        case null:
            exit = confirm("Вы действительно хотите выйти?");
            if (exit) c = false;
            break;

    }

} 


// if (start == "1") {
//     let text_task = prompt("Введите текст для новой задачи:");
//     one[0](text_task)
// } else if (start == "2") {
//     let comp_task = prompt("Введите номер задачи, которую нужно отметить выполненной: "); 
//     if (comp_task === null) {
//         alert("отмена");
//         continue;
//     } else {
//         if (isInArray(comp_task, one[3]())) {
//             one[1](comp_task);
//             alert(`Задача ${comp_task} отмечена завершенной!`);
//         } else if (isInArray(comp_task, one[4]())) {
//             alert(`Задача ${comp_task} выполнена!`);
//         } else if (isInArray(comp_task, one[5]())) {
//             alert(`Задача ${comp_task} удалена!`);
//         } else {
//             alert(`Задачи ${comp_task} не сущестует!`);
//         }
//     }
// } else if (start == "3") {
//     let comp_task = prompt("Введите номер задачи, которую хотите удалить: "); 
//     if (comp_task === null) {
//         alert("отмена");
//         continue;
//     } else {
//         if (isInArray(comp_task, one[4]())) {
//             one[2](comp_task);
//             alert(`Задача ${comp_task} успешно удалена!`);
//         } else if (isInArray(comp_task, one[3]())) {
//             alert(`Задача ${comp_task} еще не выполнена!\nУдалить можно только выполненные задачи!`);
//         } else if (isInArray(comp_task, one[5]())) {
//             alert(`Задача ${comp_task} удалена!`);
//         } else {
//             alert(`Задачи ${comp_task} не сущестует!`);
//         }
//     }
// } else if (start == "4") {
//     if (one[3]().length){
//         alert(one[3]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n"));
//     } else {
//         alert("Список не выполненных задач пуст.");
//     }
// } else if (start == "5") {
//     if (one[4]().length){
//         alert(one[4]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n"));
//     } else {
//         alert("Список завершенных задач пуст.");
//     }
// } else if (start == "6") {
//     if (one[5]().length){
//         alert(one[5]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n"));
//     } else {
//         alert("Список удаленных задач пуст.");
//     }
// } else if (start == "7") {
//     if (one[6]().length){
//         alert(one[6]().map(e => `Задача: ${e.n} ${e.text}, статус: ${e.status}`).join("\n"));
//     } else {
//         alert("Список всех задач пуст.");
//     }
// } else if (start == "") {
//     alert("Выберите действие");
//     continue;
// } else if (start == "8" || start === null) {
//     let exit = confirm("Вы действительно хотите выйти?");
//     if (exit) {
//         break;
//     } else {
//         continue;
//     }
// }




// let arr = [1, -1, 2, -2, 3];

// let positiveArr = arr.filter(function(number) {
//   return number > 0;
// });

// console.log(positiveArr);



// function counter() { 
//     let i = 1; 
//     return function() { return i++; };
// };

// let taskCounter = counter();

// console.log(taskCounter());
// console.log(taskCounter());