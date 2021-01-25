<template>
    <div class="main">
        <div class="main__header">
            <div class="main__header--section">
                <div class="main__header--body">
                    <h1 class="main__header--title">iAgent.uz</h1>
                    <h1 class="main__header--undertitle">База проверенной недвижимости 
                        <br>для профессионалов, помогающая <br>зарабатывать больше</h1>
                    <a href="/dash" class="btn btn-primary">Открыть</a>
                </div>
                <div class="main__header--img">
                    <img src="img/iagent.webp">
                </div>
            </div> 
        </div>
        <div class="main__unique">
            <h2>Оставьте заявку и получите <br>уникальные возможности сайта бесплатно</h2>
            <a href="#" class="btn btn-primary">Получить бесплатный доступ</a>
        </div>
        <div class="main__premium" style=" background-image: url('../img/contacti.webp');">
            <div>
                <h2>Выбирая iAgent.uz, вы:</h2>
                <p>&#10003; Получаете доступ к актуальной базе недвижимости</p>
                <p>&#10003; Экономите время</p>
                <p>&#10003; Используете уникальный функционал</p>
                <p>&#10003; Работаете с персональным менеджером</p>
            </div>
        </div>
       
    </div>
</template>
<script>

export default {
     name: "main",
     
}
</script>
<style lang="scss" scoped>
    .main{
        background-color:white;
        &__header{
            background-color: #2a81dd;
            height: 100vh;
            &--section{
                display: flex;
                justify-content: space-between;
                align-items: center;
                color:white;
                max-width: 1200px;
                margin: 0 auto;
                height: 100%;
            }
            &--title{
                font-size: 8rem;
            }
            &--undertitle{
                font-weight: normal;
                padding: 2rem 0;
            }
            &--img{
                max-width: 550px;
                img{
                    width: 100%;
                }
            }
        }
        &__unique{
            padding: 3rem 0;
            max-width: 1200px;
            margin: 0 auto;
            h2{
                font-size: 2rem;
                margin-bottom: 2rem;
            }
        }
        &__premium{
            background-color: #2a81dd;
            background-position: right center;
            background-repeat: no-repeat;
            color: white;
            div{
                max-width: 1200px;
                margin: 0 auto;
                padding: 3rem 0;
                h2{
                    font-size: 2rem;
                    margin-bottom: 1rem;
                }
                p{
                    font-size: 1.5rem;
                    margin-bottom: 1rem;
                }
            }
            
        }
    }
</style>