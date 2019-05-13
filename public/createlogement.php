<?php include_once("navbar.phtml"); ?>
<html>
<head>
    <title> Ajouter un logement </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../public/res/css/main.css" />
</head>
<body>

    <form action="createlogement.php" method = "POST">
        <p> Département </p>
        <select name="departement">
        <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
            <option>32</option>
            <option>33</option>
            <option>34</option>
            <option>35</option>
            <option>36</option>
            <option>37</option>
            <option>38</option>
            <option>39</option>
            <option>40</option>
            <option>41</option>
            <option>42</option>
            <option>43</option>
            <option>44</option>
            <option>45</option>
            <option>46</option>
            <option>47</option>
            <option>48</option>
            <option>49</option>
            <option>50</option>
            <option>51</option>
            <option>52</option>
            <option>53</option>
            <option>54</option>
            <option>55</option>
            <option>56</option>
            <option>57</option>
            <option>58</option>
            <option>59</option>
            <option>60</option>
            <option>61</option>
            <option>62</option>
            <option>63</option>
            <option>64</option>	
            <option>65</option>
            <option>66</option>	
            <option>67</option>
            <option>68</option>
            <option>69</option>
            <option>70</option>
            <option>71</option>
            <option>72</option>
            <option>73</option>
            <option>74</option>
            <option>75</option>
            <option>76</option>
            <option>77</option>
            <option>78</option>
            <option>79</option>
            <option>80</option>
            <option>81</option>
            <option>82</option>
            <option>83</option>
            <option>84</option>
            <option>85</option>
            <option>86</option>
            <option>87</option>
            <option>88</option>
            <option>89</option>
            <option>90</option>
            <option>91</option>
            <option>92</option>
            <option>93</option>
            <option>94</option>
            <option>95</option>
            <option>971</option>
            <option>972</option>
            <option>973</option>
            <option>974</option>
            <option>976</option>
        </select>

        <p> Ville </p>
        <input type="text" name="ville">

        <p>Montant du loyer ?</p>
        <input type="number" name="prix">

        <input type="submit" value="Créer"/>
    </form>



    <?php

    require '../vendor/autoload.php';
    require '../src/Logement/LogementRepository.php';
    require '../src/Logement/Logement.php';
    
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $logement= new \Logement\Logement;
    if (isset($_POST['prix'])){
    $logement.setDep($_POST['departement']);
    $logement.setVille($_POST['ville']);
    $logement.setPrix($_POST['prix']);
    $logementRepository->addLogement($logement);
    }
    ?>

    </body>
</html>