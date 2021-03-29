<style type="text/css">

* {
    box-sizing: border-box;
}

table {
    border-collapse: collapse;
}

.block {
    position: relative;
    width: 100%;
    margin-top: 200px;
}

.first {
    margin-top: 0px;
}

.block .line {
    height: 2px;
    border-bottom: solid 1px black;
}

.block .sol, .block .fa {
    position: absolute;
    height: 100px;
    background-repeat: no-repeat;
}

.block .sol {
    background-image: url(sol.png);
    background-position: 0;
}

.block .fa {
    background-image: url(fa.png);
    background-position: 0 5px;
    margin-top: 100px;
}

</style>
