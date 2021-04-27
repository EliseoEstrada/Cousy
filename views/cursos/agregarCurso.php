<main class="">
    <div class="row">
      <div class="col-12 col-md-8 offset-md-2 bg-white rounded">
        <form action="addChapter.html" class="p-3">
          <h4 class="form-signin-heading text-center">Crear nuevo curso</h4>

          <div class="text-center mb-4 mt-4">
            <img src="<?=base_url?>/assets/img/static/subirImagen.png" alt="" id="image-field" class="rounded-circle new-course-image">
          </div>
          <div class="form-group">
            <div class="custom-file">
                
                <input type="file"  class="custom-file-input form-control form-control-sm" id="newImage" lang="es" onchange="previewImage(event)" accept="image/*" required />  
                <label class="custom-file-label " for="newImage">Imagen de curso</label>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName">Nombre de curso</label>
            <input type="text" class="form-control form-control-sm" id="name" required>
          </div>
          <div class="form-group">
            <label for="inputDescription">Descripcion de curso</label>
            <textarea class="form-control form-control-sm" id="description" name="description" rows="5"  maxlength="500" required></textarea>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col pr-2 pl-0">
                <label for="selectCategory">Categoria</label>
              </div>
              <div class="col pl-2 pr-0">
                <label id="labelNewCategory" for="newCategory">Nombre de nueva categoria</label>
              </div>
            </div>
            <div class="row">
              <div class="col pr-2 pl-0">
                <select class="form-control form-control-sm" id="selectCategory" onchange="hideNewCategory(this)">
                    <option value="0" selected>Agregar nueva categoria</option>
                    <?php $categorias = Utils::showCategorias(); ?>
                    <?php foreach ($categorias as &$categoria) { ?>
                        <option value="<?=$categoria->getId()?>"><?=$categoria->getCategoria()?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col pl-2 pr-0">
                <input type="text" class="form-control form-control-sm" id="newCategory" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row ">
              <div class="col pr-2 pl-0">
                <label for="selectTypePay">Metodo de pago por</label>
              </div>
              <div class="col pl-2 pr-0">
                <label id="labelPrice" for="price">Precio por curso completo</label>
              </div>
            </div>
            <div class="row ">
              <div class="col pr-2 pl-0">
                <select class="form-control form-control-sm" id="selectTypePay" onchange="changeTextTypePay(this)" >
                  <option value="0" selected>Curso completo</option>
                  <option value="1" >Por capitulo</option>
                </select>
              </div>
              <div class="col pl-2 pr-0">
                <div class="form-group row">
                  <div class="col-sm-10 pl-0 pr-2">
                    <input type="number" class="form-control form-control-sm" id="price" name="price" required>
                  </div>
                  <label class="col-sm-2 col-form-label pl-0 pr-0 pt-1 text-left">MXN$</label>
                </div>
              </div>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <div class="form-group mt-3">
            <button type="submit" class="btn  btn-primary btn-block">Continuar</button>
          </div>
        </form>
      </div>
    </div>
</main>