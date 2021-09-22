<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<!--                <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
                <img src="/img/user.svg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Администратор</p>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => 'Пользователи', 'icon' => 'user', 'url' => ['/user/index'], 'active' => $this->context->id == 'user'],
                    ['label' => 'Верхнее меню', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                    ['label' => 'Редактируемый блок', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                    ['label' => 'Страницы', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                    ['label' => 'Новости', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                    ['label' => 'Публикации', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                    ['label' => 'О нас', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                    ['label' => 'Контакты администратора', 'icon' => 'bars', 'url' => ['#'], 'active' => $this->context->id == ''],
                ],
            ]
        ) ?>

    </section>

</aside>