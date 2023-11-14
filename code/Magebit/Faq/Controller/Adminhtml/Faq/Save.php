<?php

namespace Magebit\Faq\Controller\Adminhtml\Faq;

use Magebit\Faq\Api\FaqRepositoryInterface;
use Magebit\Faq\Model\FaqModelFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Saves FAQ action
 */
class Save extends AbstractAction
{
    /**
     * Inject dependencies (DataPersistor, FaqModelFactory)
     *
     * @inheritDoc
     */
    public function __construct(
        Context $context,
        Filter $filter,
        FaqRepositoryInterface $faqRepository,
        private readonly FaqModelFactory $faqModelFactory,
        private readonly DataPersistorInterface $dataPersistor
    ) {
        parent::__construct(
            $context,
            $filter,
            $faqRepository
        );
    }

    /**
     * Saves form data and redirects user
     *
     * In case error happens, form data persists in 'magebit_faq_form' key
     *
     * @return ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute(): ResultInterface
    {
        $data = $this->getRequest()->getPostValue();
        $id = null;

        if ($data) {
            $id = $data['id'] ?? null;
            //Get $faq by id, else create new with factory
            if ($id) {
                $faq = $this->faqRepository->get($id);
            } else {
                $faq = $this->faqModelFactory->create();
            }

            $faq->setData($data);

            try {
                $this->faqRepository->save($faq);
                $this->messageManager->addSuccessMessage(__('Item has been saved.'));
                $this->dataPersistor->clear('magebit_faq_form');

                $redirect = $this->getRequest()->getParam('redirect') ?? null;
                //Check whether user wants to leave back to grid
                if ($redirect === 'back') {
                    return $this->generateRedirectToGrid();
                }
                //Check whether user wants to create new FAQ
                if ($redirect === 'new') {
                    return $this->generateRedirectToNewForm();
                }

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('An error occurred while saving the item: ' . $e->getMessage())
                );
                $this->dataPersistor->set('magebit_faq_form', $data);
            }
        }
        //Default behavior is to redirect back to the same FAQ edit form with flash message
        return $this->generateRedirectToForm($id, true);
    }

    /**
     * Generates redirect to form
     *
     * @return ResultInterface
     */
    protected function generateRedirectToNewForm(): ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->redirectFormUrl);

        return $resultRedirect;
    }
}
