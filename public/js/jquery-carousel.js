(function($){
	//
	$.fn.carousel = function( method )
	{
		var methods =
		{
			init :										function( options ){ 			return this.each(function(){	_init(this, options);});},//plugin iniciado
			infinite:									false,//loop infinito ao clicar nas setas
			destroy :									function( options ){ 			return this.each(function(){	_destroy(this,options);});}//plugin removido
		};
		
		//----------------------------------------------------------------------
		//----------------------------------------------------------------------
		var defaults =
		{
			resizeItem						: null,//um objeto {} que checa se deve ou não redimensionar os itens - width (tamanho que o item terá em % [1 a 100])
			responsive						: null,//um objeto {} que considera a responsividade ou não - minWidth( tamanho minimo da tela para que a responsividade comece a checar)
			timerAnimSlide					: 300,//tempo para animação do slider ao clicar na seta
			itensMove						: 1,//quantidade de itens a serem movidos ao clicar nas setas
			activate						: function() {}//plugin ativado
		};
		
		var plugin_settings;//propriedades do plugin
		var plugin_element;//elemento instanciado do plugin
		var setaEsq;//seta esquerda
		var setaDir;//seta direita
		var content;//content classe
		var container;//container classe
		var wrapper_itens;//wrapper-itens classe
		var statusSlideAnim;//status para animação do slider ao clicar nas setas - checa se pode ou não animar o slider pois ele já está ou não animando
		
		//----------------------------------------------------------------------
		//----------------------------------------------------------------------

		// Method calling logic
		if ( methods[method] )//caso exista um método, esse método é chamado
		{
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		}
		else if ( typeof method === 'object' || ! method )//caso não exista um método ou seja apenas passado o objeto
		{
			return methods.init.apply( this, arguments );
		}
		else//caso o método não exista
		{
		  $.error( 'Method ' +  method + ' does not exist on jQuery.plugin' );
		}
		
		function _init($this, options)
		{
			plugin_element 						= $($this);
			plugin_settings 					= $.extend(defaults, options);				
			initialize($this);
			_activate();
		}
		
		function initialize($this)
		{
			//iniciando os objetos nas variáveis
			content = $(".content",plugin_element);
			container = $(".container",plugin_element);
			wrapper_itens = $(".wrapper-itens",plugin_element); 
			setaEsq = $(".seta-esq",plugin_element);
			setaDir = $(".seta-dir",plugin_element);

			if($(".item",content).length <= 1)
			{
				$(".wrapper-setas",plugin_element).hide();
			}
			else
			{
				//se /infinite/ == true o slider terá um loop infinito
				if(plugin_settings.infinite)
				{
					_setInfinite();
				}

				_initSetas();
			}

			if(plugin_settings.responsive)
			{
				_setResponsive();
			}

			_resizeContent();
		}
		
		//plugin ativado
		function _activate () {
			plugin_settings.activate.call(this, {});
		}
		
		//considera a responsividade
		//no redimensionamento da tela redimensiona os elementos 
		function _setResponsive ()
		{
			$(window).resize(_resizeHandlerCarousel);
			_resizeHandlerCarousel();
		}
		
		//redimensionamento da tela do usuário
		function _resizeHandlerCarousel () 
		{
			if(plugin_settings.responsive.minWidth)
			{
				//tamanho máximo para 
				var _minWidth = plugin_settings.responsive.minWidth;

				//oculta o /container/ para que seu tamanho não influencie no tamanho total do /plugin_element/
				container.hide();
				var _w = plugin_element.width();
				container.show();

				//volta o /content/ para a posição 0
				//assim evitamos dos intes ficarem em posição errada no layout
				if(_getSize(content,"marginLeft") != 0)
				{
					content.css("marginLeft",0);
				}

				container.scrollLeft(0);
				
				//redimensiona o tamanho do /container/
				if($(window).width() <= _minWidth)
				{
					container.width(_w);

					//checa se é para redimensionar o tamanho do /item/ quando a tela for redimensionada
					if(plugin_settings.resizeItem) {
						var _wResizeItem = plugin_settings.resizeItem.width;//a porcentagem do tamanho que o item irá receber após o redimensionamento
						var _wResized = (_wResizeItem * _w)/100;//o tamanho correto que o item deverá ter após o rediemnsionamento

						//pegamos todos os itens e redimensionamos
						$(".item",content).each(function(index, element) {
							$(element).width(_wResized);
						});
					}
					_resizeContent ();
				}
				else
				{
					//se a tela for maior que o tamanho mínimo
					//removemos o attr /style/ adicionado na condição acima
					container.removeAttr("style");
					if(plugin_settings.resizeItem) {
						if($(".item",content).attr('style'))
						{
							$(".item",content).each(function(index, element) {
								$(element).removeAttr("style");
							});
						}
					}
					_resizeContent ();
				}
			}
		}
		
		//clona os itens do /content/ para termos um loop infinito
		function _setInfinite ()
		{
			$(".item",content).each(function(index, element)
			{
				var _item = $(element);
				_cloneObject({from:_item, to:wrapper_itens});
			});
		}
		
		function _cloneObject (_obj)
		{
			var _from = _obj.from ;
			var _to = _obj.to;
			var _item = _from.clone();
		
			_item.appendTo(_to);
		}
		//redimensionamento do /content/
		function _resizeContent ()
		{
			//tamanho de cada item
			var _widthItem;
			//tamanho de todos os itens incrementados para redimensionar o /content/
			var _sizeItens = 0;
			
			content.width(999999);
			
			$(".item",content).each(function(index, element)
			{
				//incrementando o tamanho dos elementos para redimensionar o tamanho do /content/
				_widthItem = $(element).outerWidth(true);

				//tamanho do /content/
				_sizeItens += _widthItem;
			});
			
			content.width(_sizeItens+1);
			
		}
		
		//mouse event nas setas
		function _initSetas () 
		{
			
			setaEsq.click(function()
			{
				_moveSlide('left');
				return false;
			});

			setaDir.click(function()
			{
				_moveSlide('right');
				return false;
			});

		}
		
		function _moveSlide (arg_)
		{
			var _xMove;//movimento do slider
			var _posAtual = _getSize(content,"marginLeft");//retorna a posição atual do /content/
			var _maxPosMove = content.width() -  container.width();//o valor máximo para movimentar o /content/
			
			var widthItem = $('.item',content).outerWidth(true);//tamanho do item
			
			//se for seta direita
			if( arg_ == "right" )
			{
				_xMove = -(widthItem - _posAtual);

				if((Math.abs(_xMove) <= Math.abs(_maxPosMove)) && !statusSlideAnim)
				{
					statusSlideAnim = true;
					content.stop(true,true).animate({marginLeft:_xMove},plugin_settings.timerAnimSlide,function(){
						statusSlideAnim = false;
						if(plugin_settings.infinite)
						{
							
							if(Math.abs(_xMove) >=Math.floor(content.width()/2))
							{
								content.stop(true,true).animate({marginLeft:0},0);	
							}						
						}
					});
				}
			}
			else//se for seta esquerda
			{
				console.log();
				if(Math.abs(Math.round(_posAtual)) == 0 && plugin_settings.infinite)
				{
					_xMove = -(content.width()/2);
					content.css({marginLeft:_xMove});
					_posAtual = _xMove;
				}
				
				_xMove = (_posAtual + widthItem);
				
				if((_xMove <= 0) &&  !statusSlideAnim)
				{
					statusSlideAnim = true;
					content.stop(true,true).animate({marginLeft:_xMove},plugin_settings.timerAnimSlide,function(){
						statusSlideAnim = false;
					});
				}
			}			
		}
		
		function _destroy ( $obj, $property ) {
			$(window).unbind( "resize", _resizeHandlerCarousel );
		}
		
		//utils
		function _getSize(_obj,_css)
		{
			if(_obj.size()>0)
			{
				var _regExp = new RegExp("[a-z][A-Z]","g");
				return parseFloat(_obj.css(_css).replace(_regExp, ""));
			}
		}

		
    
	};//-------------------------------
})(jQuery);
