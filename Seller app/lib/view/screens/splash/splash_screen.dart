import 'dart:async';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:Saaman_Vendor/helper/network_info.dart';
import 'package:Saaman_Vendor/provider/auth_provider.dart';
import 'package:Saaman_Vendor/provider/splash_provider.dart';
import 'package:Saaman_Vendor/provider/theme_provider.dart';
import 'package:Saaman_Vendor/utill/app_constants.dart';
import 'package:Saaman_Vendor/utill/color_resources.dart';
import 'package:Saaman_Vendor/utill/dimensions.dart';
import 'package:Saaman_Vendor/utill/images.dart';
import 'package:Saaman_Vendor/utill/styles.dart';
import 'package:Saaman_Vendor/view/screens/auth/auth_screen.dart';
import 'package:Saaman_Vendor/view/screens/dashboard/dashboard_screen.dart';
import 'package:Saaman_Vendor/view/screens/splash/widget/splash_painter.dart';

class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    NetworkInfo.checkConnectivity(context);
    Provider.of<SplashProvider>(context, listen: false)
        .initConfig(context)
        .then((bool isSuccess) {
      if (isSuccess) {
        Provider.of<SplashProvider>(context, listen: false)
            .initShippingTypeList(context, '');
        Timer(Duration(seconds: 1), () {
          if (Provider.of<AuthProvider>(context, listen: false).isLoggedIn()) {
            Provider.of<AuthProvider>(context, listen: false)
                .updateToken(context);
            Navigator.of(context).pushReplacement(MaterialPageRoute(
                builder: (BuildContext context) => DashboardScreen()));
          } else {
            Navigator.of(context).pushReplacement(MaterialPageRoute(
                builder: (BuildContext context) => AuthScreen()));
          }
        });
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Stack(
      clipBehavior: Clip.none,
      children: [
        Container(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
          color: Provider.of<ThemeProvider>(context).darkTheme
              ? Colors.black
              : ColorResources.getPrimary(context),
          child: CustomPaint(
            painter: SplashPainter(),
          ),
        ),
        Center(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Image.asset(Images.logo,
                  height: 80.0,
                  fit: BoxFit.scaleDown,
                  width: 80.0,
                  color: Theme.of(context).highlightColor),
              SizedBox(
                height: Dimensions.PADDING_SIZE_EXTRA_LARGE,
              ),
              Text(
                AppConstants.APP_NAME,
                style: titilliumBold.copyWith(
                    fontSize: Dimensions.FONT_SIZE_WALLET,
                    color: Provider.of<ThemeProvider>(context).darkTheme
                        ? Colors.white
                        : ColorResources.WHITE),
              ),
            ],
          ),
        ),
      ],
    ));
  }
}
