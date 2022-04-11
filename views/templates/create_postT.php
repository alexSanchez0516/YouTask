<section id="wrap_create_articles" class="container">

    

    <div class="row">
        <div class="col">
            
            <form class="row g-3" method="post">
                <div class="col-12">
                    <label for="inputName" class="form-label">Titulo</label>
                    <input 
                    type="text" 
                    required name="name" 
                    placeholder="Escribe aquí el título de tu post" 
                    class="form-control" 
                    id="inputEmail4"
                    minlength="1"
                    maxlength="30"
                    value="<?php echo s($post->name) ?>"
                    >
                </div>
                
                <div class="col-12">
                    <label for="inputContent" class="form-label">Contenido</label>
                    <textarea 
                    required class="form-control" 
                    name="content" 
                    placeholder="Escribe aquí el contenido del post ... " 
                    id="exampleFormControlTextarea1" 
                    rows="10"><?php echo s($post->content) ?>
                    </textarea>
                </div>
                
           
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</section>