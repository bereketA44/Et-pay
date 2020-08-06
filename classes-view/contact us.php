<style>
    .mainContent{
        border: 1px solid black;
        width: 80vw;
        height: auto;
    }
    .header {
        background-color: #171520;
        color: gold;
        padding: 15px 30px;
        text-align: center;
        box-shadow: 1px 1px 30px gray;
        margin-bottom: 0px;
    }
    .header>h2 {
        display: inline-block;
        margin: 0;
        font-weight: 500;
        font-family: Optima, Helvetica, sans-serif;
    }
    .logodiv{
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        background-color: #171520;
        height: auto;
    }
    .logo{
        width: 40%;
        text-align: center;
        font-family: Artistic;
        color: gold;
        font-size: 120px;
        border-right: 1px solid gold;
        margin-top: -10px;
    }
    .contacts>h3{
        color: gold;
        margin-left: 40px;
    }
    .comment{
        background-color: whitesmoke;
        height: auto;
        overflow-y: auto;
        padding-top: 20px;
        white-space: normal;
    }
    .form-control{
        width: 30vw;
    }
    .form-group{
        margin-bottom: 70px;
    }
    textarea{
        max-width: 85vw;
    }
    @media (max-width: 768px){
        .mainContent{
            width: 93vw;
        }
        .logodiv{
            flex-direction: column;
        }
        .logo{
            width: 100%;
            border-right: 0px solid gold;
            border-bottom: 1px solid gold;
        }
        .contacts>h3{
            margin-left: 10px;
        }
        .form-control{
            width: 80vw;
        }
    }

</style>

<div class="mainContent">
    <div class= "header">
        <h2>Contact Us</h2>
    </div>
    <div class="info">
        <div class="logodiv">
            <h2 class="logo">Et-Pay</h2>
            <div class="contacts">
                <h3>Etpay.webhost000.com</h3>
                <h3>bereketababub@gmail.com</h3>
                <h3>0910297998</h3>
            </div>
        </div>
    </div>
    <div class="comment">
        <form action="">
            <h3 style="margin-top: 0; font-family: Optima, Helvetica, sans-serif;">Write down any comment or question and send it to us.</h3>
            <div class="form-group">
                <label for="date" class="control-label col-sm-3 col-xs-12">Enter your email </label>
                <div class="col-sm-9 col-xs-12">
                    <input type="email" name="email" placeholder="email" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="BillNUmber" class="control-label col-sm-3 col-xs-12">Enter your comment here </label>
                <div class="col-sm-6 col-xs-12">
                   <textarea name="comment" id="" cols="60" rows="4"></textarea>
                </div>
            </div>
            <div class="col-xs-offset-5 col-xs-6 targetdiv" >
                <button type="button" class="btn btn-info" id="next" >Send</button>
            </div>
        </form>
    </div>
</div>