<?php

use yii\db\Migration;

/**
 * Class m210428_134558_create_rbac_data
 */
class m210428_134558_create_rbac_data extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$auth = Yii::$app->authManager;

		//product permissions
		$createProduct = $auth->createPermission('createProduct');
		$auth->add($createProduct);
		$viewProduct = $auth->createPermission('viewProduct');
		$auth->add($viewProduct);
		$deleteProduct = $auth->createPermission('deleteProduct');
		$auth->add($deleteProduct);
		$updateProduct = $auth->createPermission('updateProduct');
		$auth->add($updateProduct);

		//categories
		$createCategory = $auth->createPermission('createCategory');
		$auth->add($createCategory);
		$viewCategory = $auth->createPermission('viewCategory');
		$auth->add($viewCategory);
		$deleteCategory = $auth->createPermission('deleteCategory');
		$auth->add($deleteCategory);
		$updateCategory = $auth->createPermission('updateCategory');
		$auth->add($updateCategory);

		//marks
		$createMarks = $auth->createPermission('createMarks');
		$auth->add($createMarks);
		$viewMarks = $auth->createPermission('viewMarks');
		$auth->add($viewMarks);
		$deleteMarks = $auth->createPermission('deleteMarks');
		$auth->add($deleteMarks);
		$updateMarks = $auth->createPermission('updateMarks');
		$auth->add($updateMarks);

		//productcolors
		$createProductColors = $auth->createPermission('createProductColors');
		$auth->add($createProductColors);
		$viewProductColors = $auth->createPermission('viewProductColors');
		$auth->add($viewProductColors);
		$deleteProductColors = $auth->createPermission('deleteProductColors');
		$auth->add($deleteProductColors);
		$updateProductColors = $auth->createPermission('updateProductColors');
		$auth->add($updateProductColors);

		//relationscategory
		$createRelationsCategory = $auth->createPermission('createRelationsCategory');
		$auth->add($createRelationsCategory);
		$viewRelationsCategory = $auth->createPermission('viewRelationsCategory');
		$auth->add($viewRelationsCategory);
		$deleteRelationsCategory = $auth->createPermission('deleteRelationsCategory');
		$auth->add($deleteRelationsCategory);
		$updateRelationsCategory = $auth->createPermission('updateRelationsCategory');
		$auth->add($updateRelationsCategory);

		//subCategories
		$createSubCategories = $auth->createPermission('createSubCategories');
		$auth->add($createSubCategories);
		$viewSubCategories = $auth->createPermission('viewSubCategories');
		$auth->add($viewSubCategories);
		$deleteSubCategories = $auth->createPermission('deleteSubCategories');
		$auth->add($deleteSubCategories);
		$updateSubCategories = $auth->createPermission('updateSubCategories');
		$auth->add($updateSubCategories);

		//users
		$createUser = $auth->createPermission('createUser');
		$auth->add($createUser);
		$viewUser = $auth->createPermission('viewUser');
		$auth->add($viewUser);
		$deleteUser = $auth->createPermission('deleteUser');
		$auth->add($deleteUser);
		$updateUser = $auth->createPermission('updateUser');
		$auth->add($updateUser);

		//define roles

		$moderatorRole = $auth->createRole('moderator');
		$auth->add($moderatorRole);

		$adminRole = $auth->createRole('administrator');
		$auth->add($adminRole);

		$auth->addChild($moderatorRole, $createProduct);
		$auth->addChild($moderatorRole, $viewProduct);
		$auth->addChild($moderatorRole, $deleteProduct);
		$auth->addChild($moderatorRole, $updateProduct);
		$auth->addChild($moderatorRole, $createCategory);
		$auth->addChild($moderatorRole, $viewCategory);
		$auth->addChild($moderatorRole, $deleteCategory);
		$auth->addChild($moderatorRole, $updateCategory);
		$auth->addChild($moderatorRole, $createMarks);
		$auth->addChild($moderatorRole, $viewMarks);
		$auth->addChild($moderatorRole, $deleteMarks);
		$auth->addChild($moderatorRole, $updateMarks);
		$auth->addChild($moderatorRole, $createProductColors);
		$auth->addChild($moderatorRole, $viewProductColors);
		$auth->addChild($moderatorRole, $deleteProductColors);
		$auth->addChild($moderatorRole, $updateProductColors);
		$auth->addChild($moderatorRole, $createRelationsCategory);
		$auth->addChild($moderatorRole, $viewRelationsCategory);
		$auth->addChild($moderatorRole, $deleteRelationsCategory);
		$auth->addChild($moderatorRole, $updateRelationsCategory);
		$auth->addChild($moderatorRole, $createSubCategories);
		$auth->addChild($moderatorRole, $viewSubCategories);
		$auth->addChild($moderatorRole, $deleteSubCategories);
		$auth->addChild($moderatorRole, $updateSubCategories);

		$auth->addChild($adminRole, $moderatorRole);
		$auth->addChild($adminRole, $createUser);
		$auth->addChild($adminRole, $viewUser);
		$auth->addChild($adminRole, $deleteUser);
		$auth->addChild($adminRole, $updateUser);

		$auth->assign($adminRole, 1);
	}

}
