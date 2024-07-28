<?php
    include_once '../app/db.php';
    include_once '../vendor/token.php';

    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Start output buffering
    ob_start();

    $dbObj = new DB();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];

        $name = trim($_POST['name']);
        $company = trim($_POST['company']);
        $domain = trim($_POST['domain']);
        $purchaseDate = trim($_POST['purchaseDate']);
        $package = trim($_POST['package']);
        $price = trim($_POST['price']);
        $duration = trim($_POST['duration']);
        $category = "company";
        $verify_token = generateRandomToken();

        $query = "SELECT domain_name FROM verify WHERE domain_name = '$domain'";
        $result = $dbObj->select($query);

        // Check if the query was successful and if any rows are returned
        if ($result && $result->num_rows > 0) {
            $value = $result->fetch_assoc();
            // Check if the domain exists in the result
            if (!empty($value['domain_name'])) {
                ob_end_clean();
                echo json_encode(['status' => 'error', 'message' => 'This domain has already been purchased. You can renew this.']);
                exit();
            }
        }


        $packageDurations = [
            'basic' => 30,
            'premium' => 90,
            'enterprise' => 180
        ];

        if (empty($name)) {
            $errors['name'] = 'Name is required.';
        }

        if (empty($company)) {
            $errors['company'] = 'Company Name is required.';
        }

        if (empty($domain)) {
            $errors['domain'] = 'Domain is required.';
        }

        if (empty($purchaseDate)) {
            $errors['purchaseDate'] = 'Purchase Date is required.';
        }

        if (empty($package)) {
            $errors['package'] = 'Package Type is required.';
        }

        if (empty($price)) {
            $errors['price'] = 'Price is required.';
        }

        if (empty($duration)) {
            $errors['duration'] = 'Package Duration is required.';
        }

        if (empty($errors)) {
            $expirationDate = date('Y-m-d', strtotime($purchaseDate . ' + ' . $packageDurations[$package] . ' days'));
            $query = "INSERT INTO verify(name, company_name, domain_name, category, verify_token, verify_expire_date, verify_days)
                    VALUES('$name', '$company', '$domain', '$category', '$verify_token', '$expirationDate', '$duration')";
            
            $res = $dbObj->insert($query);

            if ($res === true) {
                // Clean the buffer and return success message
                ob_end_clean();
                echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
                exit();
            } else {
                // Clean the buffer and return error message
                ob_end_clean();
                echo json_encode(['status' => 'error', 'message' => 'Failed to save data.']);
                exit();
            }
        } else {
            // Clean the buffer and return validation errors
            ob_end_clean();
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Package</title>
    <link rel="shortcut icon" href="../public/icons/package.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Purchase Package</h1>

        <div class="note">
            <p>
                <strong style="color:darkred;">Note:</strong> You have no package. If you want to use our project, please purchase a package first. Our packages offer various features and durations to suit your needs.
            </p>
        </div>

        <form id="purchaseForm">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <div class="error" id="nameError"></div>

            <label for="company">Company Name</label>
            <input type="text" id="company" name="company">
            <div class="error" id="companyError"></div>

            <label for="domain">Domain</label>
            <input type="text" id="domain" name="domain">
            <div class="error" id="domainError"></div>

            <label for="purchaseDate">Purchase Date</label>
            <input type="date" id="purchaseDate" name="purchaseDate">
            <div class="error" id="purchaseDateError"></div>

            <label for="package">Package Type</label>
            <select id="package" name="package">
                <option value="">Select a package</option>
                <option value="basic">Basic</option>
                <option value="premium">Premium</option>
                <option value="enterprise">Enterprise</option>
            </select>
            <div class="error" id="packageError"></div>

            <label for="price">Price</label>
            <input type="text" id="price" name="price" readonly>
            <div class="error" id="priceError"></div>

            <label for="duration">Package Duration (Days)</label>
            <input type="text" id="duration" name="duration" readonly>
            <div class="error" id="durationError"></div>

            <input type="submit" value="Purchase">
        </form>

        <div class="package-details" id="packageDetails">
            <p><strong>Package Details:</strong></p>
            <p id="packageType"></p>
            <p id="packagePrice"></p>
            <p id="packageExpire"></p>
        </div>

        <div class="packages">
            <div class="package">
                <h2>Basic Package</h2>
                <ul>
                    <li>All Features</li>
                    <li>3000 words</li>
                    <li>All grammar topics</li>
                </ul>
            </div>
            <div class="package">
                <h2>Premium Package</h2>
                <ul>
                    <li>All Features</li>
                    <li>6000 words</li>
                    <li>All grammar topics</li>
                    <li>Very fast response</li>
                    <li>Unlock features</li>
                </ul>
            </div>
            <div class="package">
                <h2>Enterprise Package</h2>
                <ul>
                    <li>All Features</li>
                    <li>6000 words</li>
                    <li>All grammar topics</li>
                    <li>Very fast response</li>
                    <li>Unlock features</li>
                    <li>Communicate teams</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="../resources/js/style.js"></script>

    <script>
        $(document).ready(function() {
            const packages = {
                basic: { price: "500", duration: 30 },
                premium: { price: "1000", duration: 90 },
                enterprise: { price: "1500", duration: 180 }
            };

            $('#package').on('change', function() {
                const selectedPackage = packages[this.value];
                if (selectedPackage) {
                    $('#price').val(selectedPackage.price);
                    $('#duration').val(selectedPackage.duration);
                } else {
                    $('#price').val('');
                    $('#duration').val('');
                }
            });

            $('#purchaseForm').on('submit', function(event) {
                event.preventDefault();
                let isValid = true;

                $('.error').text('');

                if ($('#name').val().trim() === '') {
                    $('#nameError').text('Name is required.');
                    isValid = false;
                }

                if ($('#company').val().trim() === '') {
                    $('#companyError').text('Company Name is required.');
                    isValid = false;
                }

                if ($('#domain').val().trim() === '') {
                    $('#domainError').text('Domain is required.');
                    isValid = false;
                }

                if ($('#purchaseDate').val().trim() === '') {
                    $('#purchaseDateError').text('Purchase Date is required.');
                    isValid = false;
                }

                if ($('#package').val().trim() === '') {
                    $('#packageError').text('Package Type is required.');
                    isValid = false;
                }

                if ($('#price').val().trim() === '') {
                    $('#priceError').text('Price is required.');
                    isValid = false;
                }

                if ($('#duration').val().trim() === '') {
                    $('#durationError').text('Package Duration is required.');
                    isValid = false;
                }

                if (isValid) {
                    $.ajax({
                        url: 'purchase.php',
                        type: 'POST',
                        data: $('#purchaseForm').serialize(),
                        success: function(response) {
                            try {
                                let res = JSON.parse(response);
                                if (res.status === 'success') {
                                    alert(res.message);
                                    window.location.href = '../index.php';
                                } else {
                                    if (res.errors) {
                                        for (let field in res.errors) {
                                            $(`#${field}Error`).text(res.errors[field]);
                                        }
                                    } else {
                                        alert(res.message);
                                    }
                                }
                            } catch (e) {
                                alert('Failed to parse server response.');
                                console.error('Parsing error:', e);
                                console.error('Response:', response);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred while processing your request.');
                            console.error('AJAX error:', error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
