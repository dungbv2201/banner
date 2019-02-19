require(['jquery',
   'mage/utils/template',
    'uiElement'
],function($,templateRender,Element){
   var viewModelConstructor = Element.extend({
      'defaults':{
         'ourDefaultValue':'Look at our value!'
      }
   });
   var viewModel =  new viewModelConstructor();
   console.log(viewModel.ourDefaultValue);
   var viewVars        = {
      'salutation':'What a Crazy'
   };

   haha = 'dung';
   var data ='hello anh chi em ${haha}';
   console.log(templateRender.template(data));
   $('#demo').html(`<h3>hello magento/framework</h3>`);
});