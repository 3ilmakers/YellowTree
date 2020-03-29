# Example Django search
```SQL
SELECT idmovie,`a`-1 as `a`, `b`-0 as `b`, `c`-0 as `c`, `d`-1 as `d`, `e`-0 as `e`, `f`-0 as `f`, `g`-1 as `g`, `h`-0 as `h`, `i`-2 as `i`, `j`-1 as `j`, `k`-0 as `k`, `l`-0 as `l`, `m`-0 as `m`, `n`-1 as `n`, `o`-1 as `o`, `p`-0 as `p`, `q`-0 as `q`, `r`-0 as `r`, `s`-0 as `s`, `t`-0 as `t`, `u`-0 as `u`, `v`-0 as `v`, `w`-0 as `w`, `x`-0 as `x`, `y`-0 as `y`, `z`-0 as `z`, `0`-0 as `0`, `1`-0 as `1`, `2`-0 as `2`, `3`-0 as `3`, `4`-0 as `4`, `5`-0 as `5`, `6`-0 as `6`, `7`-0 as `7`, `8`-0 as `8`, `9`-0 as `9`, abs(`sum`-6) as `neosum`, `sum` as `origsum`,
abs(`a`-1)+abs(`b`-0)+abs(`c`-0)+abs(`d`-1)+abs(`e`-0)+abs(`f`-0)+abs(`g`-1)+abs(`h`-0)+abs(`i`-0)+abs(`j`-1)+abs(`k`-0)+abs(`l`-0)+abs(`m`-0)+abs(`n`-1)+abs(`o`-1)+abs(`p`-0)+abs(`q`-0)+abs(`r`-0)+abs(`s`-0)+abs(`t`-0)+abs(`u`-0)+abs(`v`-0)+abs(`w`-0)+abs(`x`-0)+abs(`y`-0)+abs(`z`-0)+abs(`0`-0)+abs(`1`-0)+abs(`2`-0)+abs(`3`-0)+abs(`4`-0)+abs(`5`-0)+abs(`6`-0)+abs(`7`-0)+abs(`8`-0)+abs(`9`-0) as possum
FROM `SEARCH`  
ORDER BY `possum`,`neosum`  ASC
```
