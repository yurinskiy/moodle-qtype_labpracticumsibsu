# Тип вопроса "Лабораторный практикум СибГУ"

Используется для создания интерактивных практикумов с применением js.
Для того чтобы данный вопрос помечался выполненным или частично выполненым, 
необходимо в тексте вопроса реализовать на языке JavaScript 
заполнение скрытого поля input класса result требуемым значением из таблицы 

% выполнения вопроса | Значение поля input
--- | ---
100 | f899139df5e1059396431415e770c6dd
 95 | 812b4ba287f5ee0bc9d43bbf5bbe87fb
 90 | 8613985ec49eb8f757ae6439e879bb2a
 85 | 3ef815416f775098fe977004015c6193
 80 | f033ab37c30201f73f142449d037028d
 75 | d09bf41544a3365a46c9077ebb5e35c3
 70 | 7cbbc409ec990f19c78c75bd1e06f215
 65 | fc490ca45c00b1249bbe3554a4fdf6fb
 60 | 072b030ba126b2f4b2374f342be9ed44
 55 | b53b3a3d6ab90ce0268229151c9bde11
 50 | c0c7c76d30bd3dcaefc96f40275bdc0a
 45 | 6c8349cc7260ae62e3b1396831a8398f
 40 | d645920e395fedad7bbbed0eca3fe2e0
 35 | 1c383cd30b7c298ab50293adfecb7b18
 30 | 34173cb38f07f89ddbebc2ac9128303f
 25 | 8e296a067a37563370ded05f5a3bf3ec
 20 | 98f13708210194c475687be6106a3b84
 15 | 9bf31c7ff062936a96d3c8bd1f8f2ff3
 10 | d3d9446802a44259755d38e6d163e820
  5 | e4da3b7fbbce2345d7772b0674a318d5
  
Пример реализации приведен ниже (см. [Пример текста вопроса](#пример-текста-вопроса)).

## Установка

### Установка с использованием Git 

Для установки с помощью git выполните следующие команды из корня установленной Moodle:

    git clone https://gitlab.com/YuriyYurinskiy/lab-practicum-sibsu-question-type-moodle.git question/type/labpracticumsibsu
    echo '/question/type/labpracticumsibsu/' >> .git/info/exclude

Затем запустите процесс обновления Moodle
Администрирование > Уведомления

## Пример текста вопроса

    <button id="lab2">Solve</button>
    <script>
        $('button#lab2').click(function(e) {
            e.preventDefault();
            $(this).parentsUntil('.jsanswer').find('input.result[type=hidden]').val('f899139df5e1059396431415e770c6dd');
        });
    </script>
