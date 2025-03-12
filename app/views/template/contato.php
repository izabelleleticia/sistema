<main>
    <section class="formContato">
            <article class="site">
                <div style="">
                    <h2>Contato - Mestre Motores</h2>
                    <form action="email.php" method="POST">
                        <div>
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                        
                            <label for="fone">Telefone:</label>
                            <input type="tel" id="fone" name="fone" placeholder="Digite seu telefone com DDD" required>
                        
                        
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                        
                        
                            <label for="mensagem">Mensagem:</label>
                            <textarea id="mensagem" name="mensagem" placeholder="Digite aqui sua mensagem" required></textarea>
                        
                        <div>
                            <input type="submit" value="ENVIAR">
                            <input type="reset" value="LIMPAR">
                        </div>
                    </div>
                    <div></div>
                    </form>
</div>
            </article>
        </section>