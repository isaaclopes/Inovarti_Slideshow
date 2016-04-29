<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */

class Inovarti_Slideshow_Adminhtml_Slideshow_SlideshowController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/slideshow');
    }

    protected function _initAction()
    {
        $this->loadLayout()
                ->_setActiveMenu('inovarti/slideshow/slideshow/items')
            ->_addBreadcrumb(Mage::helper('slideshow')->__('Slideshow Export'), Mage::helper('slideshow')->__('Slideshow Export'));

        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Manage Slideshows'));
        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('slideshow/adminhtml_slideshow'))
                ->renderLayout();
    }

    public function editAction()
    {
        $this->_testWritable();

        $model = $this->getModel();

        if ($model->getId()) {
            $this->_title($model->getTitle());

            $this->_initAction();

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit'))
                ->_addLeft($this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('The slideshow does not exist.'));
            $this->_redirect('*/*/');
        }
    }
    public function newAction()
    {
        $this->_testWritable();

        $model = $this->getModel();
        $this->_title($this->__('New Slideshow'));

        $this->_initAction();

        $this->_addContent($this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit'))
            ->_addLeft($this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit_tabs'));

        $this->renderLayout();
    }
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null) {
                $result['file'] = '';
                try {
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('image');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);

                    // Set the file upload mode 
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders 
                    //	(file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS . 'slideshow' . DS;
                    $result = $uploader->save($path, $_FILES['image']['name']);
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage() . '  ' . $path);
                    Mage::getSingleton('adminhtml/session')->setFormData($data);
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }

                $data['image'] = $result['file'];
            }
            if ($data['from_date'] != NULL) {
                $data['from_date'] = Mage::app()->getLocale()->date()->setDate($data['from_date'])->setTime(date("H:i:s"))->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            }
            if ($data['to_date'] != NULL) {
                $data['to_date'] = Mage::app()->getLocale()->date()->setDate($data['to_date'])->setTime(date("H:i:s"))->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            }
            if (!isset($data['miniatura_mosaic'])) {
                $data['miniatura_mosaic'] = 0;
            }

            $model = $this->getModel();
            $model->addData($data);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slideshow')->__('Slideshow was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back') == 'edit') {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }

                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('Unable to find slideshow to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        try {
            $model = $this->getModel();
            $model->delete();
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

            return;
        }

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slideshow')->__('Slideshow was successfully deleted'));
        $this->_redirect('*/*/');
    }
    public function massDeleteAction() {
        $slideshowIds = $this->getRequest()->getParam('slideshow');
        if (!is_array($slideshowIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select slide(s)'));
        } else {
            try {
                foreach ($slideshowIds as $slideshowId) {
                    $slideshow = Mage::getModel('slideshow/slideshow')->load($slideshowId);
                    $slideshow->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($slideshowIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $slideshowIds = $this->getRequest()->getParam('slideshow');
        if (!is_array($slideshowIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select slide(s)'));
        } else {
            try {
                foreach ($slideshowIds as $slideshowId) {
                    $slideshow = Mage::getSingleton('slideshow/slideshow')
                            ->load($slideshowId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($slideshowIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }


    public function getModel()
    {
        $model = Mage::getModel('slideshow/slideshow');

        if ($this->getRequest()->getParam('id')) {
            $model->load($this->getRequest()->getParam('id'));
        }

        Mage::register('current_model', $model);

        return $model;
    }

    protected function _testWritable()
    {
        $path = Mage::helper('slideshow')->getBasePath();

        if (!Mage::helper('slideshow')->isWritable($path)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('The path "%s" is not writable!', $path));
        }
    }
}