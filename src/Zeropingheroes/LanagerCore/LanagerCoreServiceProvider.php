<?php namespace Zeropingheroes\LanagerCore;

use Illuminate\Support\ServiceProvider;

class LanagerCoreServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('zeropingheroes/lanager-core');

		$this->app->register('VTalbot\Markdown\MarkdownServiceProvider');
		$this->app->register('Bootstrapper\BootstrapperServiceProvider');

		include __DIR__.'/../../routes.php';
		include __DIR__.'/../../composers.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['LanagerCore'] = $this->app->share(function($app)
		{
			return new LanagerCore;
		});

		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('LanagerCore'   ,'Zeropingheroes\LanagerCore\Facades\LanagerCore');
			$loader->alias('Markdown'      ,'VTalbot\Markdown\Facades\Markdown');
			$loader->alias('Markdown'      ,'VTalbot\Markdown\Facades\Markdown');
			$loader->alias('Alert'         ,'Bootstrapper\Alert');
			$loader->alias('Badge'         ,'Bootstrapper\Badge');
			$loader->alias('Breadcrumb'    ,'Bootstrapper\Breadcrumb');
			$loader->alias('Button'        ,'Bootstrapper\Button');
			$loader->alias('ButtonGroup'   ,'Bootstrapper\ButtonGroup');
			$loader->alias('ButtonToolbar' ,'Bootstrapper\ButtonToolbar');
			$loader->alias('Carousel'      ,'Bootstrapper\Carousel');
			$loader->alias('DropdownButton','Bootstrapper\DropdownButton');
			$loader->alias('Form'          ,'Bootstrapper\Form');
			$loader->alias('Helpers'       ,'Bootstrapper\Helpers');
			$loader->alias('Icon'          ,'Bootstrapper\Icon');
			$loader->alias('Image'         ,'Bootstrapper\Image');
			$loader->alias('Label'         ,'Bootstrapper\Label');
			$loader->alias('MediaObject'   ,'Bootstrapper\MediaObject');
			$loader->alias('Navbar'        ,'Bootstrapper\Navbar');
			$loader->alias('Navigation'    ,'Bootstrapper\Navigation');
			$loader->alias('Paginator'     ,'Bootstrapper\Paginator');
			$loader->alias('Progress'      ,'Bootstrapper\Progress');
			$loader->alias('Tabbable'      ,'Bootstrapper\Tabbable');
			$loader->alias('Table'         ,'Bootstrapper\Table');
			$loader->alias('Thumbnail'     ,'Bootstrapper\Thumbnail');
			$loader->alias('Typeahead'     ,'Bootstrapper\Typeahead');
			$loader->alias('Typography'    ,'Bootstrapper\Typography');
		});

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}