<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Attributes_model');
		$this->load->model('Category_model');
		$this->load->model('Tags_model');
		$this->load->model('Brand_model');
		$this->load->model('Cart_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Settings_model');
		$this->load->model('Page_model');
		
	}

	public function index()
	{
		$data['tags_list'] = $this->Tags_model->GetTags();
		$data['product_list'] = $this->Product_model->GetProducts();
		
		$this->load->view('admin/manageproduct',$data);
	}
	public function ProductDetail($id)
	{
		
		$this->load->library('cart');
		$data['review_list'] = $this->Product_model->GetReviews();
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['product_detail'] = $this->Product_model->getProductById($id);
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['page_list'] = $this->Page_model->GetPages();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$categoryId = $data['product_detail'][0]['CategoryId'];
		$BrandId = $data['product_detail'][0]['BrandId'];

		$data['parent_category'] = $this->Category_model->GetCategoryById($categoryId);
		$data['parent_brand'] = $this->Brand_model->GetBrandById($BrandId);
		$this->load->model('Tags_model');
		$data['tag_list'] = $this->Tags_model->GetTags();
		// echo "<pre>";
		// // die(print_r($data));
		// die(print_r($data['product_detail']));

		$this->load->view('productdetail',$data);
	}

	public function delete($productId)
	{
		$this->Product_model->deleteProduct($productId);
		$this->Tags_model->deleteProductTags($productId);
		$this->Attrbutes_model->deleteProductAttributes($productId);
		redirect(base_url() . "Product/index");
	}

	public function SaveProduct()
	{
		
		$this->load->model("Brand_model");
		$this->load->model("Category_model");
		/* Load form validation library */
		$this->load->library('form_validation');
		/* Set validation rule for name field in the form */
		$this->form_validation->set_rules('productName', 'Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['brand_list'] = $this->Brand_model->GetBrands();
			$data['category_list'] = $this->Category_model->GetCategories();
			$data['attributes_list'] = $this->Attributes_model->GetAttributes();
			$data['tags_list'] = $this->Tags_model->GetTags();
			$data['news_list'] = $this->Newsitem_model->GetNewsitem();
			$data['setting_list'] = $this->Settings_model->GetSettings();
			$data['page_list'] = $this->Page_model->GetPages();
			$this->load->view('admin/addnewproduct',$data);
		} else {

			
			
			//print_r($_POST);
			//die;
			$data['Picture']= json_encode($this->fileUpload());

						//Product Info
			$data['Name'] = $this->input->post('productName');
			
			$data['ShortDescription'] = $this->input->post( 'shortDescription');
			$data[ 'LongDescription'] = $this->input->post('fullDescription');
			$data['Code'] = $this->input->post('code');
			$data[ 'CategoryId'] = $this->input->post('ParentCategoryId');
			$data['BrandId'] = $this->input->post('ParentBrandId');
			if ($this->input->post('published') == "true") {
				$data['Published'] = 1;
			} else {
				$data['Published'] = 0;
			}
			if ($this->input->post( 'showInHomePage') == "true") {
				$data[ 'ShowOnHomePage'] = 1;
			} else {
				$data[ 'ShowOnHomePage'] = 0;
			}
			$data[ 'ProductType'] = $this->input->post( 'productType');
			$data['VendorId'] = $this->input->post('VendorId');
			if ($this->input->post( 'requireOtherProducts') == "true") {
				$data[ 'ReqOtherProduct'] = 1;
			} else {
				$data[ 'ReqOtherProduct'] = 0;
			}
			if ($this->input->post( 'allowCustomerReviews') == "true") {
				$data[ 'CustomerReview'] = 1;
			} else {
				$data[ 'CustomerReview'] = 0;
			}
			if ($this->input->post('featuredProduct') == "true") {
				$data['Featured'] = 1;
			} else {
				$data['Featured'] = 0;
			}
			if ($this->input->post('bestSeller') == "true") {
				$data['BestSeller'] = 1;
			} else {
				$data['BestSeller'] = 0;
			}
			
			$data[ 'AvailStartDate'] = $this->input->post( 'availableStartDate');
			$data[ 'AvailEndDate'] = $this->input->post( 'availableEndDate');
			if ($this->input->post('markAsNew') == "true") {
				$data['MarkNew'] = 1;
			} else {
				$data['MarkNew'] = 0;
			}


						//Price
			$data[ 'Price'] = $this->input->post( 'price');
			$data[ 'OldPrice'] = $this->input->post( 'oldPrice');
			if ($this->input->post('productCost') == "true") {
				$data['CostPrice'] = 1;
			} else {
				$data['CostPrice'] = 0;
			}
			if ($this->input->post('disableBuyButton') == "true") {
				$data['DisableBuyButton'] = 1;
			} else {
				$data['DisableBuyButton'] = 0;
			}
			if ($this->input->post('disableWishlistButton') == "true") {
				$data['DisableWishList'] = 1;
			} else {
				$data['DisableWishList'] = 0;
			}
			if ($this->input->post('callForPrice') == "true") {
				$data['CallForPrice'] = 1;
			} else {
				$data['CallForPrice'] = 0;
			}
			if ($this->input->post('customerEnterPrice') == "true") {
				$data['ShowOnHomePage'] = 1;
			} else {
				$data['ShowOnHomePage'] = 0;
			}
			$data['Discount'] = $this->input->post('discount');
			$data['RValue'] = $this->input->post( 'rValue');
			$data['STax'] = $this->input->post( 'saleTax');
			$data['STaxPer'] = $this->input->post( 'saleTaxPercentage');


						//Shipping
			if ($this->input->post('shipping') == "true") {
				$data[ 'ShippingEnable'] = 1;
			} else {
				$data[ 'ShippingEnable'] = 0;
			}
			if ($this->input->post( 'shipSep') == "true") {
				$data[ 'ShipSep'] = 1;
			} else {
				$data['ShipSep'] = 0;
			}
			$data[ 'AddChargesShip'] = $this->input->post( 'chargesShip');
			$data[ 'DeliveryTime'] = $this->input->post( 'deliveryTime');


					//Inventory
			$data[ 'InventoryMethod'] = $this->input->post( 'ManageInventoryMethodId');
			$data['MinCartQty'] = $this->input->post('minimumCartQty');
			$data['MaxCartQty'] = $this->input->post('maximumCartQty');
			if ($this->input->post('notReturnable') == "true") {
				$data['NotReturnAble'] = 1;
			} else {
				$data['NotReturnAble'] = 0;
			}

					//GiftCard
			if ($this->input->post( 'giftCard') == "true") {
				$data[ 'IsGiftCard'] = 1;
			} else {
				$data[ 'IsGiftCard'] = 0;
			}

					//Downloadable
			if ($this->input->post( 'downloadableProject') == "true") {
				$data[ 'DownloadAble'] = 1;
			} else {
				$data[ 'DownloadAble'] = 0;
			}

			

					//Rental
			if ($this->input->post( 'rental') == "true") {
				$data[ 'Rental'] = 1;
			} else {
				$data[ 'Rental'] = 0;
			}

			if ($this->input->post('featuredProduct') == "true") {
				$data['Featured'] = 1;
			} else {
				$data['Featured'] = 0;
			}
			if ($this->input->post('bestSeller') == "true") {
				$data['BestSeller'] = 1;
			} else {
				$data['BestSeller'] = 0;
			}

					//SEO
			$data[ 'SEFriendlyPage'] = $this->input->post('SearchProductName');
			$data[ 'MetaTitle'] = $this->input->post('metaTitle');
			$data[ 'MetaKeyword'] = $this->input->post('metaKeyWord');
			
			
					//Dates
			$data['CreatedDate'] = Date('Y-m-d');
			$data['CreatedBy'] = "1";
			$data[ 'ModifiedDate'] = Date('Y-m-d');
			$data[ 'ModifiedBy'] = "1";
			// echo "<pre>";
			// die(print_r($data));
			// die();
			$this->load->model('Product_model');
			$productId = $this->Product_model->SaveProduct($data);
			
					//Attributes
			$this->load->model('Attributes_model');
			$attributes = $this->input->post('attributes');
			foreach($attributes as $attribute_id => $attr_value){
				if(!empty($attr_value)){
					$attributeData['AttributeId'] = $attribute_id;
					$attributeData['ProductId'] = $productId;
					$attributeData['AttValue'] = $attr_value;
					$this->Attributes_model->addProductAttributes($attributeData);
				}
			}

					//Tags
			$this->load->model('Tags_model');
			$tagData['productId'] = $productId;
			$tag_list = $this->input->post('tag[]');
			foreach($tag_list as $tag){
				$tagData['tagId'] = $tag;
				$this->Tags_model->addProductTags($tagData);
			}
			// echo "<pre>";
			// print_r($tagData);
			// die();
			$strUrl = base_url() . "Product";
			header("Location:" . $strUrl);
		}
	}

	public function edit($id)
	{
		$this->load->model("Product_model");
		$this->load->model("Category_model");
		$this->load->model("Brand_model");
		$brand = $this-> Product_model->getProductById($id);
		$arr = array();
		$arr['product'] = $brand[0];
		$this->form_validation->set_rules( 'productName', 'Product Name', 'required');
		if ($this->form_validation->run() == false) {
			$arr['brand_list'] = $this->Brand_model->GetBrands();
			$arr['category_list'] = $this->Category_model->GetCategories();
			$arr['attributes_list'] = $this->Attributes_model->GetAttributes();
			$arr['tags_list'] = $this->Tags_model->GetTags();
			$arr['setting_list'] = $this->Settings_model->GetSettings();
			$data['page_list'] = $this->Page_model->GetPages();
			$this->load->view('admin/editproduct', $arr);
		} else {
			$this->fileUpload();
			//Price
			$data['Name'] = $this->input->post('productName');
			$data['Price'] = $this->input->post('price');
			$data['OldPrice'] = $this->input->post('oldPrice');
			if ($this->input->post('productCost') == "true") {
				$data['CostPrice'] = 1;
			} else {
				$data['CostPrice'] = 0;
			}
			if ($this->input->post('disableBuyButton') == "true") {
				$data['DisableBuyButton'] = 1;
			} else {
				$data['DisableBuyButton'] = 0;
			}
			if ($this->input->post('disableWishlistButton') == "true") {
				$data['DisableWishList'] = 1;
			} else {
				$data['DisableWishList'] = 0;
			}
			if ($this->input->post('callForPrice') == "true") {
				$data['CallForPrice'] = 1;
			} else {
				$data['CallForPrice'] = 0;
			}
			if ($this->input->post('customerEnterPrice') == "true") {
				$data['ShowOnHomePage'] = 1;
			} else {
				$data['ShowOnHomePage'] = 0;
			}
			$data['Discount'] = $this->input->post('discount');
			$data['RValue'] = $this->input->post('rValue');
			$data['STax'] = $this->input->post('saleTax');
			$data['STaxPer'] = $this->input->post('saleTaxPercentage');


			//Shipping
			if ($this->input->post('shipping') == "true") {
				$data['ShippingEnable'] = 1;
			} else {
				$data['ShippingEnable'] = 0;
			}
			if ($this->input->post('shipSep') == "true") {
				$data['ShipSep'] = 1;
			} else {
				$data['ShipSep'] = 0;
			}
			$data['AddChargesShip'] = $this->input->post('chargesShip');
			$data['DeliveryTime'] = $this->input->post('deliveryTime');


			//Inventory
			$data['InventoryMethod'] = $this->input->post('ManageInventoryMethodId');
			$data['MinCartQty'] = $this->input->post('minimumCartQty');
			$data['MaxCartQty'] = $this->input->post('maximumCartQty');
			if ($this->input->post('notReturnable') == "true") {
				$data['NotReturnAble'] = 1;
			} else {
				$data['NotReturnAble'] = 0;
			}

			//GiftCard
			if ($this->input->post('giftCard') == "true") {
				$data['IsGiftCard'] = 1;
			} else {
				$data['IsGiftCard'] = 0;
			}

			//Downloadable
			if ($this->input->post('downloadableProject') == "true") {
				$data['DownloadAble'] = 1;
			} else {
				$data['DownloadAble'] = 0;
			}

			//Rental
			if ($this->input->post('rental') == "true") {
				$data['Rental'] = 1;
			} else {
				$data['Rental'] = 0;
			}

			if ($this->input->post('featuredProduct') == "true") {
				$data['Featured'] = 1;
			} else {
				$data['Featured'] = 0;
			}
			if ($this->input->post('bestSeller') == "true") {
				$data['BestSeller'] = 1;
			} else {
				$data['BestSeller'] = 0;
			}

			//SEO
			$data['SEFriendlyPage'] = $this->input->post('SearchProductName');
			$data['MetaTitle'] = $this->input->post('metaTitle');
			$data['MetaKeyword'] = $this->input->post('metaKeyWord');


			//Dates
			$data['ModifiedDate'] = Date('Y-m-d');
			$data['ModifiedBy'] = "1";


			$this->Product_model->update($id, $data);
			$this->session->set_flashdata("success", "Record Updated Successfully");

			//Attributes
			$this->load->model('Attributes_model');
			$attributes = $this->input->post('attributes');
			print_r($attributes);
			foreach ($attributes as $attribute_id => $attr_value) {
				if (!empty($attr_value)) {
					$attributeData['AttValue'] = $attr_value;
					if ($this->Attributes_model->getProductAttribuesById($id)) {
						$this->Attributes_model->updateProductAttributes($id, $attribute_id, $attributeData);
					} else {
						$this->Attributes_model->addProductAttributes($attributeData);
					}
				}
			}

			//Tags
			$this->load->model('Tags_model');
			$tagData['productId'] = $id;
			$this->Tags_model->deleteProductTags($id);
			$tag_list = $this->input->post('tag[]');
			foreach ($tag_list as $tag) {
				$tagData['tagId'] = $tag;
				$this->Tags_model->addProductTags($tagData);
			}
			
			
			redirect(base_url() . 'product');
		}
	}

	public function fileUpload()
	{
		
		$data = array();
		// If file upload form submitted
		if (!empty($_FILES['uploadPicture']['name'])) {
			
			$filesCount = count($_FILES['uploadPicture']['name']);
			
			for ($i = 0; $i < $filesCount; $i++) {
				$_FILES['file']['name']     = $_FILES['uploadPicture']['name'][$i];
				$_FILES['file']['type']     = $_FILES['uploadPicture']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['uploadPicture']['tmp_name'][$i];
				$_FILES['file']['error']     = $_FILES['uploadPicture']['error'][$i];
				$_FILES['file']['size']     = $_FILES['uploadPicture']['size'][$i];

				// File upload configuration
				$uploadPath = 'upload';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				// Load and initialize upload library
				$this->load->library('upload');
				$this->upload->initialize($config);

				// Upload file to server
				if ($this->upload->do_upload('file')) {
					// Uploaded file data
					
					$fileData = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $fileData['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 100;
					$config['height'] = 100;
					$this->load->library('image_lib', $config);
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
					$uploadData[$i] = $fileData['file_name'];
				}
			}

			return $uploadData;
			
		}
		else {
			return FALSE;
		}
	}

	function delete_all()
	{
		$this->load->model('Product_model');
		if ($this->input->post('checkbox_value')) {
			$id = $this->input->post('checkbox_value');
			for ($count = 0; $count < count($id); $count++) {
				$this->Product_model->deleteProduct($id[$count]);
			}
		}
	}

	function productreview($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text-review', 'Review', 'required');
		$this->form_validation->set_rules('userEmail', 'Email', 'required');
		if ($this->form_validation->run() == FALSE) {
			//print_r($_POST);
			redirect(base_url().'Product/productdetail/'.$id);
		} else {
			$data['ReviewText'] = $this->input->post('text-review');
			$data['Rating'] = $this->input->post('rating');
			$data['ProductId'] = $id;
			$data['IsApproved'] = "NotApproved";
			$data['CustomerEmail'] = $this->input->post('userEmail');
			$data['CustomerId'] = $this->input->post('userid');
			$data['CreatedDate'] = Date('Y-m-d');
			$this->load->model('Product_model');
			$this->Product_model->saveReview($data);
			redirect(base_url() . 'Product/productdetail/' . $id);
		}
	}

	public function productReviewShow(){
		$data['review_list'] = $this->Product_model->GetReviews();
		$this->load->view('admin/managereviews', $data);
	}

	public function approveReview(){
		$data['IsApproved'] = $this->input->post('status');
		$id = $this->input->post('reviewid');
		$this->load->model('Product_model');
		$val = $this->Product_model->updateReviewStatus($id, $data);
		echo $data['IsApproved'];
	}

	public function productByTags($tagId){
		$this->load->model("Tags_model");
		$products_id = $this->Tags_model->getProductsByTagsId($tagId);
		$data['Child_Product'] = $this->Product_model->getProductByIds($products_id);
		$_SESSION['cartAdd'] = NULL;
		$this->load->model('Product_model');
		$data['product_list'] = $this->Product_model->GetProducts();
		$this->load->library('cart');
		$data['category_list'] = $this->Category_model->GetCategories();
		$this->load->model('Tags_model');
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();
		$this->load->view('categoryproduct',$data);
	}

	public function searchProduct(){
		$this->load->model("Product_model");
		$this->load->model('Category_model');
		$this->load->model('Tags_model');
		$this->load->model('Blog_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Settings_model');
		$this->load->model('Page_model');
		$keyword = $this->input->get("keyword");
		
		//Searched Data
		$data['searchByName'] = $this->Product_model->searchByProductName($keyword);
		$data['searchByCategory'] = $this->Product_model->searchByCategory($keyword);
		$data['searchByTag'] = $this->Product_model->searchByTag($keyword);
		$data['searchByBrand'] = $this->Product_model->searchByBrand($keyword);
		// 
		//Essential Data
		$this->load->library('cart');
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['latest_product'] = $this->Product_model->getLatestProduct();
		$data['blog_list'] = $this->Blog_model->GetBlogs();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['page_list'] = $this->Page_model->GetPages();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		// echo "<pre>";
		// die(print_r($data));

		$this->load->view('searchProducts', $data);
		

	}
	
}
