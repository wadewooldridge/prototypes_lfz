//EXERCISE 1
var variable1 = 'hello';
var variable2 = 4;
var variable3 = ['foo', 'bar'];

//EXERCISE 2
v1 = 4;
v1 = 'hello';

//EXERCISE 3
var numbers = [3, 5, 16, 3, 4, 18];
var result = numbers[0];

for (var i = 1; i < numbers.length; i++) {
    result += numbers[i];
}

//EXERCISE 4
document.write('This is a string' + 'This is another string');

//EXERCISE 5
var my_float = 3.5;
var my_int = Math.floor(my_float);
var my_float2 = 5.3;
var my_int2 = parseInt(myfloat2);

//EXERCISE 6
var my_var1 = 'Hello';
if (my_var2 !== undefined) {
    document.write(my_var2);
} else {
    document.write(my_var1);
}

//EXERCISE 7
var check_var = 'What time is it?';

switch (check_var) {
    case 'hello':
        document.write('greetings');
        break;
    case 'bye':
        document.write('good bye');
        break;
    default:
        document.write('It\'s party time!');
        break;
}

//EXERCISE 8
var student = {
    name:   'Skippy',
    class:  'English',
    grade:  75
};

//EXERCISE 9
student = new stdClass();
student.name = 'Skippy';
student.class = 'English';
student.grade = 75;

//EXERCISE 10
var num_array = [35, 2, 14, 56, 65, 52];

function find_greatest_num_and_index(direction) {
    var greatest = null;
    var greatest_index = null;
    var i;
    var increment;
    var end_loop;

    if (direction >= 0) {
        i = 0;
        increment = 1;
        end_loop = num_array.length;
    } else {
        i = num_array.length;
        increment = -1;
        end_loop = 0;
    }

    while (i != end_loop) {
        if (num_array[i] > greatest) {
            greatest = num_array[i];
            greatest_index = i;
        }
        i += increment;
    }

    return {
        greatest: greatest,
        greatest_index: greatest_index};
}
