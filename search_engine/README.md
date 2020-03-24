# SEARCH ENGINE
## System
The motor must prevent of misstyped errors made by users.
The motor is splited in two parts

### Description search
Low priority in terms of result. Basicaly search via MySQL using
```MySQL
SELECT * FROM TABLE WHERE column LIKE "%word%";
```
### Title search
High priority in terms of result. <br>
We will have a table where each column will be a letter of alphabet (and numerous) that will register how many times this letter is repeated in the title by words.

|id_movie  |  A | B | ... | 0 |SUM|
|----|----|---|---|---|---|
|782  |  3 | 0 |...| 0 |23|

The nearest result will be selected.

#### Example

"DJANGO UNCHAINED" will give you

|id_movie  |  A | B | C | D | E | F | G | H | I | J | K | L | M | N | O | P | Q | R | S | T | U | V | W | X | Y | Z |SUM|
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
|782 |  1 |   |   | 1 |   |   | 1 |   |   | 1  |   |   |   | 1 | 1 |   |   |   |   |   |   |   |   |   |   |   | 6 |
|782 |  1 |   | 1 | 1 | 1 |   |   | 1 | 1 |   |   |   |   | 2 |   |   |   |   |   |   | 1 |   |   |   |   |   | 9 |

Imagine that user misstype "JANGO". Then our search will look like this :

|id_movie  |  A | B | C | D | E | F | G | H | I | J | K | L | M | N | O | P | Q | R | S | T | U | V | W | X | Y | Z |SUM|
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
|unkwn |  1 |   |   |  |   |   | 1 |   |   | 1  |   |   |   | 1 | 1 |   |   |   |   |   |   |   |   |   |   |   | 5 |

Now we apply substraction between reference line and the search for each letters and let's see what happen next :

|id_movie  |  A | B | C | D | E | F | G | H | I | J | K | L | M | N | O | P | Q | R | S | T | U | V | W | X | Y | Z |SUM|ZEROS|
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
|782_DJANGO - unkwn |  0 |   |   | 1 |   |   | 0 |   |   | 0  |   |   |   | 0 | 0 |   |   |   |   |   |   |   |   |   |   |   | 1 |1|
|782_UNCHAINED - unkwn |  0 |   |   |   |   |   | -1| 1 |  1| -1 |   |   |   | 1 | -1|   |   |   |   |   | 1 |   |   |   |   |   | 4 |19|

and there we see that `SUM(782_DJANGO-unkwn) = SUM(782_DJANGO)-SUM(unkwn)` <br>
and we also see that `SUM(782_UNCHAINED-unkwn) != SUM(782_UNCHAINED)-SUM(unkwn)` <br>
then we can order our result and see that DJANGO match with JANGO
