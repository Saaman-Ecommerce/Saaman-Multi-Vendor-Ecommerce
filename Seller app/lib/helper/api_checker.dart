import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:Saaman_Vendor/data/model/response/base/api_response.dart';
import 'package:Saaman_Vendor/provider/auth_provider.dart';
import 'package:Saaman_Vendor/view/screens/auth/auth_screen.dart';

class ApiChecker {
  static void checkApi(BuildContext context, ApiResponse apiResponse) {
    if (apiResponse.error.toString() ==
        'Failed to load data - status code: 401') {
      Provider.of<AuthProvider>(context, listen: false).clearSharedData();
      Navigator.of(context).pushAndRemoveUntil(
          MaterialPageRoute(builder: (context) => AuthScreen()),
          (route) => false);
    } else {
      String _errorMessage;
      if (apiResponse.error is String) {
        _errorMessage = apiResponse.error.toString();
      } else {
        _errorMessage = apiResponse.error.errors[0].message;
      }
      print(_errorMessage);
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          content: Text(_errorMessage, style: TextStyle(color: Colors.white)),
          backgroundColor: Colors.red));
    }
  }
}
