// Петя очень любит футбол. Однажды, глядя футбольный матч, он записывал на листе бумаги текущее положение игроков.
// Для простоты он изобразил ситуацию в виде строки из нулей и единиц. Ноль соответствует игрокам одной команды, единица —
//  игрокам другой команды. Если есть как минимум 7 игроков некоторой команды, стоящих подряд, то эта ситуация считается опасной.
//  Например, ситуация 00100110111111101 — опасная, а 11110111011101 — нет. Вам задана текущая ситуация. Определите, является ли
//  она опасной. Задайте непустую строку из символов «0» и «1», обозначающих игроков. Длина строки не превышает 100 символов.
// То есть нужно наполнить строку случайным порядком. От каждой команды на поле присутствует хотя бы один игрок. Выведите «YES»
// если ситуация опасная. В противном случае выведите «NO». Если установлена node.js, можно просто запускать из консоли скрипт,
// либо же написать простую html страничку со скриптом.

function randomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

let randomNum = randomInteger(1, 10e29);
let randomNumToBinary = randomNum.toString(2).concat("0", "1");

function dangerOrNot() {
    let count1 = 0;
    let count2 = 0;
    for (let i = 0; i <= randomNumToBinary.length; i++) {
        console.log(console.dir({ count1, count2 }));
        if (randomNumToBinary.split("")[i] == 0) {
            count1++;
            if (count1 == 7) {
                return "YES 0";
            }
        } else {
            count1 = 0;
        }

        if (randomNumToBinary.split("")[i] == 1) {
            count2++;
            if (count2 == 7) {
                return "YES 1";
            }
        } else {
            count2 = 0;
        }
    }
    return "NO";
}

// return randomNum.toString(2).concat("0", "1").includes("1111111")
//     ? "YES"
//     : "NO";

console.dir({
    binary: randomNum.toString(2).concat("0", "1"),
    randomNum: randomNum,
    length: randomNum.toString(2).length,
});

console.log(dangerOrNot());
