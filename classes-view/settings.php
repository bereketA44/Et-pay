
<style>
.mainContent{
    width: 80vw;
    font-family: Optima, Helvetica, sans-serif;
    /* border: 5px solid black; */
    white-space: normal;
}
.header {
    background-color: #171520;
    color: gold;
    padding: 15px 30px;
    text-align: center;
    box-shadow: 1px 1px 30px gray;
    margin-bottom: 30px;
}
.header>h2 {
        display: inline-block;
        margin: 0;
        font-weight: 500;
}
.formField, .form-group{
    width: 80vw;
}
label{
    font-size: 22px;
    margin-right: 10px;
}
.toggles{
    display: block;
}
table{
    margin-left: 30px;
    width: 80vw;;
}
.td-custom{
    width: 15vw;
}
@media (max-width: 768px){
    .mainContent{
        width: 93vw;
    }
    .td-custom{
        width: 55vw;
    }
    .td-custom>label{
        font-size: 15px;
    }
    table{
        margin-left: 0px;
    }
}
</style>
<div class="mainContent">
    <div class= "header">
        <h2>Settings</h2>
    </div>
    <div class="formField">
        <form action="" class="form-group">
            <h2>You can change your settings below.</h2>
            <table class="table">
                <tr>
                    <th></th><th></th>
                </tr>
                <tr>
                    <td class="td-custom"><label> Get Updates through Email: </label></td><td><input type="checkbox" checked data-toggle="toggle"></td>
                </tr>
                <tr>
                    <td class="td-custom"><label> Get Notifications: </label></td><td><input type="checkbox" checked data-toggle="toggle"></td>
                </tr>
                <tr>
                    <td class="td-custom"> <label> Get Messages: </label></td><td><input type="checkbox" checked data-toggle="toggle"></td>
                </tr>
                <tr>
                    <td class="td-custom"><label> Get Updates through Email: </label></td><td><input type="checkbox" checked data-toggle="toggle"></td>
                </tr>

            </table>
        </form>
    </div>
</div>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>