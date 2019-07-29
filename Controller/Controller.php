<?php

namespace HugoSoltys\FitzBundle\Controller;

use HugoSoltys\FitzBundle\Helper\FileHelper;
use HugoSoltys\FitzBundle\Installer\InstallerInterface;
use HugoSoltys\FitzBundle\Model\AvailableBundles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class Controller extends AbstractController
{
    /** @var array */
    private $bundles;

    /** @var string */
    private $queueFilePath;

    /**
     * Controller constructor.
     * @param array $bundles
     * @param string $queueFilePath
     */
    public function __construct(array $bundles, string $queueFilePath)
    {
        $this->bundles = $bundles;
        $this->queueFilePath = $queueFilePath;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function install(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $data = $request->request->all();
            if (isset($data['bundles'])) {
                $bundles = $data['bundles'];
                foreach ($bundles as $bundle) {
                    $serviceName = isset(AvailableBundles::BUNDLES[$bundle]['service']) ? AvailableBundles::BUNDLES[$bundle]['service'] : 'fitz.default_installer';
                    $installer = $this->get($serviceName);
                    if (!$installer instanceof InstallerInterface) {
                        throw new \Exception(\sprintf("Installer for bundle %s was not found.", $bundle));
                    }
                    $installer->setBundleName($bundle);
                    if (!$installer->isQueued()) {
                        $installer->queue();
                    }
                }

                return $this->redirectToRoute('hugo_soltys_fitz_install');
            }
        }

        return $this->render('@Fitz/index.html.twig', [
            'installedBundles' => \array_keys($this->bundles),
            'availableBundles' => AvailableBundles::BUNDLES,
            'installing' => FileHelper::getContent(\sprintf('%s/%s', $this->queueFilePath, AvailableBundles::QUEUE_FILE)),
        ]);
    }
}