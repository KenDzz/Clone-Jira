-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 10:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clone_jira`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`) VALUES
(1, 'Task'),
(2, 'Story'),
(3, 'Bug');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'da40478f-5c70-48f5-86cf-04b151358599', 'database', 'default', '{\"uuid\":\"da40478f-5c70-48f5-86cf-04b151358599\",\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":1:{s:26:\\\"\\u0000App\\\\Jobs\\\\SendMailJob\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 02\\\";s:5:\\\"email\\\";s:21:\\\"clonepro808@gmail.com\\\";s:4:\\\"desc\\\";s:0:\\\"\\\";}}\"}}', 'ErrorException: Undefined variable $desc in D:\\BaiTap\\htdocs\\baitap\\CloneJira\\storage\\framework\\views\\0f4aa846e7780a4f460fa7da7bbdd99adf98dd3f.php:87\nStack trace:\n#0 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'D:\\\\BaiTap\\\\htdoc...\', 87)\n#1 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\storage\\framework\\views\\0f4aa846e7780a4f460fa7da7bbdd99adf98dd3f.php(87): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'D:\\\\BaiTap\\\\htdoc...\', 87)\n#2 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(109): require(\'D:\\\\BaiTap\\\\htdoc...\')\n#3 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(110): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire(\'D:\\\\BaiTap\\\\htdoc...\', Array)\n#5 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(70): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'D:\\\\BaiTap\\\\htdoc...\', Array)\n#6 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(195): Illuminate\\View\\Engines\\CompilerEngine->get(\'D:\\\\BaiTap\\\\htdoc...\', Array)\n#7 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(178): Illuminate\\View\\View->getContents()\n#8 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(147): Illuminate\\View\\View->renderContents()\n#9 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(383): Illuminate\\View\\View->render()\n#10 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(360): Illuminate\\Mail\\Mailer->renderView(\'mail.Notificati...\', Array)\n#11 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(272): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'mail.Notificati...\', NULL, NULL, Array)\n#12 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(212): Illuminate\\Mail\\Mailer->send(\'mail.Notificati...\', Array, Object(Closure))\n#13 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(213): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#15 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(309): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#16 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(253): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\NotificationJoinProject))\n#17 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\PendingMail.php(124): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\NotificationJoinProject))\n#18 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\app\\Jobs\\SendMailJob.php(39): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\NotificationJoinProject))\n#19 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#20 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#21 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#22 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#23 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#24 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#25 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendMailJob))\n#26 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailJob))\n#27 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendMailJob), false)\n#29 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendMailJob))\n#30 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailJob))\n#31 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#32 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendMailJob))\n#33 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#34 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#35 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(375): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#36 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(173): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#37 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#38 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#39 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#40 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#41 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#42 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#43 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#44 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(183): Illuminate\\Container\\Container->call(Array)\n#45 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Command\\Command.php(291): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#46 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(153): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#47 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(1014): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(102): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(155): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#53 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $desc (View: D:\\BaiTap\\htdocs\\baitap\\CloneJira\\resources\\views\\mail\\Notification\\JoinJob.blade.php) in D:\\BaiTap\\htdocs\\baitap\\CloneJira\\storage\\framework\\views\\0f4aa846e7780a4f460fa7da7bbdd99adf98dd3f.php:87\nStack trace:\n#0 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(60): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(70): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'D:\\\\BaiTap\\\\htdoc...\', Array)\n#2 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(195): Illuminate\\View\\Engines\\CompilerEngine->get(\'D:\\\\BaiTap\\\\htdoc...\', Array)\n#3 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(178): Illuminate\\View\\View->getContents()\n#4 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(147): Illuminate\\View\\View->renderContents()\n#5 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(383): Illuminate\\View\\View->render()\n#6 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(360): Illuminate\\Mail\\Mailer->renderView(\'mail.Notificati...\', Array)\n#7 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(272): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'mail.Notificati...\', NULL, NULL, Array)\n#8 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(212): Illuminate\\Mail\\Mailer->send(\'mail.Notificati...\', Array, Object(Closure))\n#9 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#10 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(213): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#11 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(309): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#12 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(253): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\NotificationJoinProject))\n#13 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\PendingMail.php(124): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\NotificationJoinProject))\n#14 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\app\\Jobs\\SendMailJob.php(39): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\NotificationJoinProject))\n#15 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#16 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#18 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#19 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#20 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#21 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendMailJob))\n#22 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailJob))\n#23 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendMailJob), false)\n#25 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendMailJob))\n#26 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailJob))\n#27 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendMailJob))\n#29 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#30 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(375): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#32 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(173): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#35 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#38 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#39 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#40 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(183): Illuminate\\Container\\Container->call(Array)\n#41 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Command\\Command.php(291): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(153): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(1014): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(102): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(155): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 {main}', '2024-03-04 21:49:39'),
(2, '007f051f-cb9d-4277-afc5-4581adcd4553', 'database', 'default', '{\"uuid\":\"007f051f-cb9d-4277-afc5-4581adcd4553\",\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":1:{s:26:\\\"\\u0000App\\\\Jobs\\\\SendMailJob\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 02\\\";s:5:\\\"email\\\";s:21:\\\"clonepro808@gmail.com\\\";s:4:\\\"desc\\\";s:0:\\\"\\\";}}\"}}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\SendMailJob has been attempted too many times or run too long. The job may have previously timed out. in D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php:746\nStack trace:\n#0 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(505): Illuminate\\Queue\\Worker->maxAttemptsExceededException(Object(Illuminate\\Queue\\Jobs\\DatabaseJob))\n#1 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(415): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), 1)\n#2 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(375): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#3 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(173): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#4 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#5 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#6 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#8 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#9 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#10 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#11 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(183): Illuminate\\Container\\Container->call(Array)\n#12 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Command\\Command.php(291): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#13 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(153): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#14 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(1014): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#15 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#16 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#17 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(102): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#18 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(155): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#19 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 {main}', '2024-03-04 21:50:09'),
(3, 'b4d4c48a-b34e-4ccd-88f4-1ecfb329ca9a', 'database', 'default', '{\"uuid\":\"b4d4c48a-b34e-4ccd-88f4-1ecfb329ca9a\",\"displayName\":\"App\\\\Jobs\\\\SendMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailJob\",\"command\":\"O:20:\\\"App\\\\Jobs\\\\SendMailJob\\\":1:{s:26:\\\"\\u0000App\\\\Jobs\\\\SendMailJob\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 03\\\";s:5:\\\"email\\\";s:19:\\\"deepweb9x@gmail.com\\\";s:4:\\\"desc\\\";s:22:\\\"notification.join.desc\\\";}}\"}}', 'ErrorException: fgets(): SSL: An existing connection was forcibly closed by the remote host in D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\Stream\\AbstractStream.php:77\nStack trace:\n#0 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(270): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'fgets(): SSL: A...\', \'D:\\\\BaiTap\\\\htdoc...\', 77)\n#1 [internal function]: Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'fgets(): SSL: A...\', \'D:\\\\BaiTap\\\\htdoc...\', 77)\n#2 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\Stream\\AbstractStream.php(77): fgets(Resource id #878)\n#3 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(315): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#4 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(181): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#5 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(285): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->executeCommand(\'NOOP\\r\\n\', Array)\n#6 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(190): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->ping()\n#7 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#8 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mailer\\SentMessage), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#9 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(523): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#10 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(287): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#11 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(212): Illuminate\\Mail\\Mailer->send(\'mail.Notificati...\', Array, Object(Closure))\n#12 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(213): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#14 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(309): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#15 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(253): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\NotificationJoinProject))\n#16 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\PendingMail.php(124): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\NotificationJoinProject))\n#17 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\app\\Jobs\\SendMailJob.php(39): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\NotificationJoinProject))\n#18 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendMailJob->handle()\n#19 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#21 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#22 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#23 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#24 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendMailJob))\n#25 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailJob))\n#26 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendMailJob), false)\n#28 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendMailJob))\n#29 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendMailJob))\n#30 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#31 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendMailJob))\n#32 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#33 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(375): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#35 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(173): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#36 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#37 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#38 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#41 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#42 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(661): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#43 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(183): Illuminate\\Container\\Container->call(Array)\n#44 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Command\\Command.php(291): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#45 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(153): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#46 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(1014): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(301): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(102): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(155): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 D:\\BaiTap\\htdocs\\baitap\\CloneJira\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 {main}', '2024-03-04 23:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(15, 'default', '{\"uuid\":\"a403cb09-4a8f-4c30-a210-2b0dc7c2128e\",\"displayName\":\"App\\\\Jobs\\\\SendMailTask\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailTask\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMailTask\\\":1:{s:27:\\\"\\u0000App\\\\Jobs\\\\SendMailTask\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 03\\\";s:5:\\\"email\\\";s:19:\\\"deepweb9x@gmail.com\\\";s:4:\\\"desc\\\";s:50:\\\"Hello, You have just added a new task hi KenDzz 2!\\\";}}\"}}', 0, NULL, 1709777542, 1709777542),
(16, 'default', '{\"uuid\":\"67e3c449-11c0-4e2d-8d94-a9564a90ca3a\",\"displayName\":\"App\\\\Jobs\\\\SendMailTask\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailTask\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMailTask\\\":1:{s:27:\\\"\\u0000App\\\\Jobs\\\\SendMailTask\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 03\\\";s:5:\\\"email\\\";s:19:\\\"deepweb9x@gmail.com\\\";s:4:\\\"desc\\\";s:50:\\\"Hello, You have just added a new task hi KenDzz 2!\\\";}}\"}}', 0, NULL, 1709777578, 1709777578),
(17, 'default', '{\"uuid\":\"94207096-9c38-4f87-aa22-b182791b1cb4\",\"displayName\":\"App\\\\Jobs\\\\SendMailTask\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailTask\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMailTask\\\":1:{s:27:\\\"\\u0000App\\\\Jobs\\\\SendMailTask\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 03\\\";s:5:\\\"email\\\";s:19:\\\"deepweb9x@gmail.com\\\";s:4:\\\"desc\\\";s:50:\\\"Hello, You have just added a new task hi KenDzz 2!\\\";}}\"}}', 0, NULL, 1709777770, 1709777770),
(18, 'default', '{\"uuid\":\"4a91a71b-f2bc-4caf-8f48-8da07c465b66\",\"displayName\":\"App\\\\Jobs\\\\SendMailTask\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailTask\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMailTask\\\":1:{s:27:\\\"\\u0000App\\\\Jobs\\\\SendMailTask\\u0000data\\\";O:8:\\\"stdClass\\\":3:{s:4:\\\"name\\\";s:9:\\\"KenDzz 03\\\";s:5:\\\"email\\\";s:19:\\\"deepweb9x@gmail.com\\\";s:4:\\\"desc\\\";s:52:\\\"Hello, You have just added a new task estimate time!\\\";}}\"}}', 0, NULL, 1709802372, 1709802372);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`) VALUES
(1, 'Backlog'),
(2, 'In progress'),
(3, 'Review'),
(4, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 2),
(3, '2023_08_08_013920_create_jobs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `name`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High'),
(4, 'Urgent');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(2555) NOT NULL,
  `describes` text NOT NULL,
  `is_exist` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `describes`, `is_exist`, `created_at`, `updated_at`) VALUES
(3, 'update223', 'update23', 0, '2024-03-03 20:44:22', '2024-03-04 02:41:19'),
(4, 'test-04', 'test-04', 1, '2024-03-03 20:46:24', '2024-03-03 20:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `describes` longtext NOT NULL,
  `project_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `estimate_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `category_id`, `level_id`, `name`, `describes`, `project_id`, `priority_id`, `start_time`, `estimate_time`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Hi KenDzz In progress', 'Hi KenDzz In progress', 38, 1, '2024-03-06 01:53:09', '2024-03-14 01:53:15', '2024-03-05 03:21:09', '2024-03-05 03:21:09'),
(3, 1, 3, 'Hi KenDzz Review', 'Hi KenDzz In progress', 38, 1, '2024-03-06 01:53:09', '2024-03-14 01:53:15', '2024-03-05 03:21:09', '2024-03-05 03:21:09'),
(4, 1, 4, 'Hi KenDzz Done', 'Hi KenDzz Done', 38, 1, '2024-03-06 01:53:09', '2024-03-14 01:53:15', '2024-03-05 03:21:09', '2024-03-05 03:21:09'),
(6, 3, 4, 'hi KenDzz 2', '<p>q qqqqqqqqqqqqq</p><p>&nbsp;</p><p><img src=\"http://127.0.0.1:8000/api/images/377241654_269537409281758_2602045267993803743_nbdea150dec1a94b57d10_1709792842.jpg\"><img><img></p>', 38, 4, '2024-03-10 00:10:00', '2024-03-10 00:10:00', '2024-03-05 21:52:16', '2024-03-06 23:43:21'),
(7, 3, 1, 'hi KenDzz', '<p>q</p>', 38, 4, NULL, NULL, '2024-03-05 21:53:46', '2024-03-05 21:53:46'),
(8, 3, 4, 'hi KenDzz', '<p>q</p>', 38, 4, '2024-03-06 04:00:00', '2024-03-15 12:00:00', '2024-03-05 21:55:45', '2024-03-07 00:12:02'),
(9, 2, 2, 'hi KenDzz', '<p>ggggggg</p>', 38, 4, '2024-03-15 06:00:00', '2024-03-23 14:00:00', '2024-03-05 23:47:10', '2024-03-07 00:20:18'),
(10, 3, 2, 'hi KenDzz', '<p>aaaaaaaa</p><p>&nbsp;</p><p><img src=\"http://127.0.0.1:8000/api/images/377241654_269537409281758_2602045267993803743_n6b4dc037462b1969e510_1709799260.jpg\"></p>', 4, 3, '2024-03-08 22:00:00', '2024-03-10 06:00:00', '2024-03-06 01:22:39', '2024-03-07 01:14:53'),
(11, 3, 1, 'estimate time', '<p>Helllo</p>', 4, 3, '2024-03-07 09:00:00', '2024-03-22 17:00:00', '2024-03-07 02:06:12', '2024-03-07 02:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `permission_id`, `created_at`, `updated_at`) VALUES
(2, 'KenDzz', 'vvqua.2x@gmail.com', '$2y$10$sdLu4dLFDPRFvpGXQ1i1PuGzEhr.Y5wNrxPlg3GWS1TPe9v/pWvxC', 1, '2024-03-01 01:11:26', '2024-03-01 01:11:26'),
(3, 'KenDzz 02', 'clonepro808@gmail.com', '$2y$10$JvTAaG3kOkIva9LJbaElIuRAq1HS9DhkkXiWn/3XOOljzs2mYhUTi', 2, '2024-03-04 03:17:40', '2024-03-04 03:17:40'),
(4, 'KenDzz 03', 'deepweb9x@gmail.com', '$2y$10$wPN9SRE1nYD.LPe7erYMVe.XR8V3aM5YDDKBvm2ag81wyz9CGtdeu', 2, '2024-03-04 03:24:59', '2024-03-04 03:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_project`
--

CREATE TABLE `user_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 12, 3, '2024-03-04 19:46:04', '2024-03-04 19:46:04'),
(2, 12, 4, '2024-03-04 19:46:04', '2024-03-04 19:46:04'),
(3, 17, 3, '2024-03-04 21:31:38', '2024-03-04 21:31:38'),
(4, 19, 4, '2024-03-04 21:33:53', '2024-03-04 21:33:53'),
(5, 20, 3, '2024-03-04 21:38:02', '2024-03-04 21:38:02'),
(6, 21, 3, '2024-03-04 21:40:11', '2024-03-04 21:40:11'),
(7, 22, 3, '2024-03-04 21:40:55', '2024-03-04 21:40:55'),
(8, 23, 3, '2024-03-04 21:41:35', '2024-03-04 21:41:35'),
(9, 24, 3, '2024-03-04 21:43:03', '2024-03-04 21:43:03'),
(10, 25, 3, '2024-03-04 21:44:10', '2024-03-04 21:44:10'),
(11, 26, 3, '2024-03-04 21:45:14', '2024-03-04 21:45:14'),
(12, 27, 3, '2024-03-04 21:45:45', '2024-03-04 21:45:45'),
(13, 28, 3, '2024-03-04 21:45:58', '2024-03-04 21:45:58'),
(14, 29, 3, '2024-03-04 21:46:15', '2024-03-04 21:46:15'),
(15, 30, 3, '2024-03-04 21:47:01', '2024-03-04 21:47:01'),
(16, 31, 3, '2024-03-04 21:47:47', '2024-03-04 21:47:47'),
(17, 32, 3, '2024-03-04 21:48:01', '2024-03-04 21:48:01'),
(18, 33, 3, '2024-03-04 21:48:25', '2024-03-04 21:48:25'),
(19, 34, 3, '2024-03-04 21:48:37', '2024-03-04 21:48:37'),
(20, 35, 3, '2024-03-04 21:49:37', '2024-03-04 21:49:37'),
(21, 36, 3, '2024-03-04 21:50:48', '2024-03-04 21:50:48'),
(22, 37, 4, '2024-03-04 23:27:00', '2024-03-04 23:27:00'),
(26, 38, 3, '2024-03-05 00:17:23', '2024-03-05 00:17:23'),
(27, 38, 4, '2024-03-05 00:39:24', '2024-03-05 00:39:24'),
(30, 4, 3, '2024-03-05 00:46:50', '2024-03-05 00:46:50'),
(31, 6, 3, '2024-03-06 19:05:52', '2024-03-06 19:05:52'),
(33, 6, 4, '2024-03-06 19:12:58', '2024-03-06 19:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_task`
--

CREATE TABLE `user_task` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_task`
--

INSERT INTO `user_task` (`id`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-03-05 03:21:09', '2024-03-05 03:21:09'),
(2, 5, 3, '2024-03-05 21:42:23', '2024-03-05 21:42:23'),
(3, 5, 4, '2024-03-05 21:42:23', '2024-03-05 21:42:23'),
(4, 6, 3, '2024-03-05 21:52:16', '2024-03-05 21:52:16'),
(5, 7, 3, '2024-03-05 21:53:46', '2024-03-05 21:53:46'),
(6, 8, 3, '2024-03-05 21:55:45', '2024-03-05 21:55:45'),
(7, 9, 3, '2024-03-05 23:47:10', '2024-03-05 23:47:10'),
(8, 9, 4, '2024-03-05 23:47:10', '2024-03-05 23:47:10'),
(9, 10, 3, '2024-03-06 01:22:39', '2024-03-06 01:22:39'),
(11, 11, 4, '2024-03-07 02:06:12', '2024-03-07 02:06:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_project`
--
ALTER TABLE `user_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_task`
--
ALTER TABLE `user_task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_project`
--
ALTER TABLE `user_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_task`
--
ALTER TABLE `user_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
