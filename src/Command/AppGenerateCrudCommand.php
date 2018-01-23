<?php

namespace App\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppGenerateCrudCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:generate-crud';
    const CONTROLLER_DIR = __DIR__.'\..\Controller\\';
    const TEMPLATE_DIR = __DIR__.'\..\..\templates\\';
    private $twig = null;

    protected function configure()
    {
        $this
            ->setDescription('Generate CRUD for entity provided')
            ->addArgument('entity', InputArgument::OPTIONAL, 'Entity');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $entity = $input->getArgument('entity');
        $doctrine = $this->getContainer()->get("doctrine");
        /** @var $em EntityManager*/
        $em = $doctrine->getManager();
        $metadata = $em->getClassMetadata($entity);
        $this->twig = $this->getContainer()->get('twig');

        $name = $metadata->getName();
        $classNameArray = explode('\\', $name);
        $className = $classNameArray[(sizeof($classNameArray)-1)];
        $bundleName = $classNameArray[0];
        if($this->checkIfControllerExists($metadata->getName())){

        } else {
            $this->generateController($className, $bundleName);
            $this->generateTemplates(['metadata' => $metadata, 'className' => $className]);
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }

    /**
     * @param $className
     * @return bool
     */
    private function checkIfControllerExists($className)
    {
        return file_exists(self::CONTROLLER_DIR.$className.'Controller.php');
    }


    /**
     * @param $className
     * @param $bundleName
     */
    private function generateController($className, $bundleName)
    {
        $fileContent = $this->twig->render('skeleton\controller_template.php.twig',
            array('className' => $className,
                'bundleName' => $bundleName,
                'classPrefix' => $this->camel2dashed($className),
                'routePath' => 'ss',
                'routeName' => 'aa'));
        file_put_contents(self::CONTROLLER_DIR.$className.'Controller.php', $fileContent);
    }

    private function generateTemplates($data)
    {
        /** @var ClassMetadata $metadata */
        $metadata = $data['metadata'];
        $fields = $this->getFieldsFromMetadata($metadata);
        $relationships = $this->getRelationships($metadata);
        $fileContent = $this->twig->render('skeleton\create_template.html.twig',
            array('className' => $data['className'].'Controller',
                'fields' => $fields,
                'relationships' => $relationships,
                'saveRoute' => $this->camel2dashed( $data['className'])
            ));
        if(file_exists(self::TEMPLATE_DIR.'/'.$data['className'])) {
        } else {
            mkdir(self::TEMPLATE_DIR.'/'.$data['className']);
        }
        file_put_contents(self::TEMPLATE_DIR.'/'.$data['className'].'/'.$this->camel2dashed($data['className']).'-create.html.twig', $fileContent);

    }


    /**
     * @param ClassMetadata $classMetadata
     * @return array
     * @throws \Doctrine\ORM\Mapping\MappingException
     */
    private function getFieldsFromMetadata(ClassMetadata $classMetadata)
    {
        $fields = [];
        $primaryKeyName =$classMetadata->getSingleIdentifierFieldName();
        foreach ($classMetadata->getFieldNames() as $fieldName){
            if($fieldName !== $primaryKeyName) {
                $fieldMeta = $classMetadata->getFieldMapping($fieldName);
                $fields[] = ['name' => $fieldName, 'type' => $fieldMeta['type']];
            }
        }

        return $fields;
    }

    /**
     * @param ClassMetadata $classMetadata
     * @return array
     * @throws \Doctrine\ORM\Mapping\MappingException
     */
    private function getRelationships(ClassMetadata $classMetadata)
    {
        $relationships = [];
        foreach ($classMetadata->getAssociationNames() as $relName){
            $relMeta = $classMetadata->getAssociationMapping($relName);
            if($classMetadata->isSingleValuedAssociation($relName)) {
                $relationships[] = [
                    'name' => $relName,
                    'entity' => str_replace('\\', '\\\\',$relMeta['targetEntity']),
                    'type' => 'single',
                    'extensionCall' =>'{% set ' . $relName . ' = getEntities("'.$relMeta['targetEntity'].'")%}'
                ];
            } else {
                $relationships[] = ['name' => $relName, 'entity' => $relMeta['targetEntity'], 'type' => 'multiple'];
            }
        }

        return $relationships;
    }

    /**
     * @param $className
     * @return string
     */
    function camel2dashed($className) {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
    }
}
